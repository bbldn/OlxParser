<?php

namespace App\Parsers;

use App\Helpers\NodeHelper;
use Illuminate\Support\Str;
use Sunra\PhpSimple\HtmlDomParser;

class FlatParser extends Parser
{
    /**
     * @param string $text
     * @return array
     */
    public function parse(string $text): array
    {
        $result = [
            'number_of_storeys' => 0,
            'area' => 0,
            'level' => 0,
            'number_of_rooms' => 0,
            'price' => 0,
            'description_hash' => Str::random(32),
        ];

        $dom = HtmlDomParser::str_get_html($text);
        $result = $this->parseMainInformation($dom, $result);
        $result = $this->parseInformation($dom, $result);

        return $result;
    }

    /**
     * @param mixed $dom
     * @param array $result
     * @return array
     */
    protected function parseMainInformation($dom, array $result): array
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $tableNode = $dom->find('table[class=item]');
        foreach ($tableNode as $item) {
            /** @noinspection PhpUndefinedMethodInspection */
            $node = $item->find('th');
            if (false === NodeHelper::checkNode($node)) {
                continue;
            }

            switch (trim(NodeHelper::getSubNodePlainText($node, '', 0))) {
                case 'Этажность':
                    /** @noinspection PhpUndefinedMethodInspection */
                    $result['number_of_storeys'] = (int)NodeHelper::getSubNodePlainText(
                        $item->find('strong'),
                        0.0,
                        0
                    );

                    break;
                case 'Общая площадь':
                    /** @noinspection PhpUndefinedMethodInspection */
                    $result['area'] = (int)NodeHelper::getSubNodePlainText(
                        $item->find('strong'),
                        0.0,
                        0
                    );

                    break;
                case 'Этаж':
                    /** @noinspection PhpUndefinedMethodInspection */
                    $result['level'] = (int)NodeHelper::getSubNodePlainText(
                        $item->find('strong'),
                        0.0,
                        0
                    );

                    break;
                case 'Количество комнат':
                    /** @noinspection PhpUndefinedMethodInspection */
                    $result['number_of_rooms'] = (int)NodeHelper::getSubNodePlainText(
                        $item->find('strong'),
                        0.0,
                        0
                    );

                    break;
            }
        }

        return $result;
    }

    /**
     * @param $dom
     * @param array $result
     * @return array
     */
    protected function parseInformation($dom, array $result): array
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $value = NodeHelper::getSubNodePlainText($dom->find('p[class=pding10 lheight20 large]'));
        if (null !== $value) {
            $result['description_hash'] = hash('md5', trim($value));
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $node = $dom->find('strong[class=xxxx-large not-arranged]');
        if (true === NodeHelper::checkNode($node)) {
            /** @noinspection PhpUndefinedMethodInspection */
            $node = $dom->find('strong[class=xxxx-large arranged]');
        }

        $value = NodeHelper::getSubNodePlainText($node);
        if (null !== $value) {
            $result['price'] = (int)preg_replace('/([0-9]+) ([0-9]+) \$/', '$1$2', $value);
        }

        return $result;
    }
}
