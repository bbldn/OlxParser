<?php

namespace App\Parsers;

use App\District;
use App\Flat;
use App\Helpers\MainParserContext;
use App\Repositories\DistrictRepository;
use App\Repositories\FlatRepository;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Kozz\Laravel\Facades\Guzzle;

class MainParser
{
    /** @var URLFlatParser $urlParser */
    protected $urlParser;

    /** @var FlatParser $flatParser */
    protected $flatParser;

    /** @var DistrictRepository $districtRepository */
    protected $districtRepository;

    /** @var FlatRepository $flatRepository */
    protected $flatRepository;

    /** @var MainParserContext $mainParserContext */
    protected $mainParserContext;

    /** @var Collection|District[] $districts */
    protected $districts;

    /**
     * MainParser constructor.
     * @param URLFlatParser $urlParser
     * @param FlatParser $flatParser
     * @param DistrictRepository $districtRepository
     * @param FlatRepository $flatRepository
     * @param MainParserContext $mainParserContext
     */
    public function __construct(
        URLFlatParser $urlParser,
        FlatParser $flatParser,
        DistrictRepository $districtRepository,
        FlatRepository $flatRepository,
        MainParserContext $mainParserContext
    )
    {
        $this->urlParser = $urlParser;
        $this->flatParser = $flatParser;
        $this->districtRepository = $districtRepository;
        $this->flatRepository = $flatRepository;
        $this->mainParserContext = $mainParserContext;
    }

    /**
     *
     */
    public function handle(): void
    {
        $this->init();

        for ($page = 1, $numberException = 0; ; $page++) {
            try {
                $text = $this->sendRequest($this->mainParserContext->getUrl() . $page);
            } catch (Exception $e) {
                if (true === $this->handleException($e, $numberException)) {
                    return;
                }

                continue;
            }

            if (true === $this->errorChecker($text) || $page > 120) {
                return;
            }

            foreach ($this->urlParser->parse($text) as $url => $districtName) {
                try {
                    $this->parseUrl($url, $districtName);
                } catch (Exception $e) {
                    if (true === $this->handleException($e, $numberException)) {
                        return;
                    }
                }
            }
        }
    }


    /**
     * @param string $url
     * @param string $districtName
     */
    protected function parseUrl(string $url, string $districtName): void
    {
        $flatText = $this->sendRequest($url);
        if (true === $this->errorChecker($flatText)) {
            die();
        }

        $data = $this->flatParser->parse($flatText);

        /** @var District|null $district */
        $district = $this->districts->where('name', $districtName)->first();
        $data['district_id'] = null !== $district ? $district->id : null;
        $data['flat_id'] = preg_replace('/[^I]+ID([^\.]+)\.[a-zA-z0-9#;]+/', '$1', $url);

        $flat = $this->flatRepository->findOneByFlatIdOrDescriptionHash($data['flat_id'], $data['description_hash']);

        if (null === $flat) {
            $this->flatRepository->save(new Flat($data));

            return;
        }

        $this->flatRepository->touch($flat);
    }


    /**
     * @param $url
     * @return string
     */
    protected function sendRequest($url): string
    {
        /** @noinspection PhpUndefinedMethodInspection */
        /** @var Response $response */
        $response = Guzzle::get($url);

        return (string)$response->getBody();
    }

    /**
     * @param $text
     * @return bool
     */
    protected function errorChecker($text): bool
    {
        return false !== strpos($text, 'Что-то пошло не так');
    }

    /**
     * @param Exception $e
     * @param int $numberException
     * @return bool
     */
    protected function handleException(Exception $e, int & $numberException): bool
    {
        Log::error($e->getMessage());
        $numberException++;

        return $numberException > 3;
    }

    /**
     *
     */
    protected function init(): void
    {
        if (0 === count($this->districts)) {
            $this->districts = $this->districtRepository->findAll();
        }
    }
}
