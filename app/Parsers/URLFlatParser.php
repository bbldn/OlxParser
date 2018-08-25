<?php

namespace App\Parsers;

use App\Helpers\NodeHelper;
use Illuminate\Support\Arr;
use Sunra\PhpSimple\HtmlDomParser;

class URLFlatParser extends Parser
{
    /**
     * @param string $text
     * @return array
     */
    public function parse(string $text): array
    {
        $result = [];

        $dom = HtmlDomParser::str_get_html($text);
        $flatWrappers = $dom->find('h3[class=lheight22 margintop5]');
        if (false === NodeHelper::checkNode($flatWrappers)) {
            return $result;
        }

        $districtWrapper = $dom->find('i[data-icon=location-filled]');
        if (false === NodeHelper::checkNode($districtWrapper)) {
            return $result;
        }

        if (count($flatWrappers) !== count($districtWrapper)) {
            return $result;
        }

        foreach ($flatWrappers as $key => $item) {
            if (false === key_exists($key, $districtWrapper)) {
                break;
            }

            $node = $item->find('a');
            if (false === NodeHelper::checkNode($node)) {
                continue;
            }

            $url = $this->getUrl(Arr::first($node)->href);
            if (null === $url) {
                continue;
            }

            $district = $this->getDistrict($districtWrapper[$key]->parent()->plaintext);
            if (null === $district) {
                continue;
            }

            $result[$url] = $district;
        }

        return $result;
    }


    /**
     * @param string $districtText
     * @return string|null
     */
    protected function getDistrict(string $districtText): ?string
    {
        if (0 === preg_match('/.+?, (.+)/', $districtText, $matches)) {
            return null;
        }

        return trim($matches[1]);
    }


    /**
     * @param string $href
     * @return string|null
     */
    protected function getUrl(string $href): ?string
    {
        if (0 === preg_match('/[^#]+/', $href, $matches)) {
            return null;
        }

        return trim($matches[0]);
    }
}
