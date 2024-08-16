<?php

namespace Conecto\SearchBundle;

use Doctrine\ORM\Mapping\Builder\ManyToManyAssociationBuilder;
use Doctrine\ORM\QueryBuilder;
use Pimcore\Db;
use Pimcore\Model\Document\Editable;
use Pimcore\Model\Document;
use Conecto\SearchBundle\Configuration\Configuration;

class MySqlSearchService implements SearchServiceInterface
{
    /**
     * @var \Pimcore\Db\ConnectionInterface
     */
    private $db;

    public function __construct()
    {
        $this->db = Db::get();
    }

    public function getResults(string $query): array
    {
        $results = [];

        if($query) {
            // set max concatenation length to 10000 chars
            $this->db->executeQuery('SET SESSION group_concat_max_len = 10000');

            $queryBuilder = $this->db->createQueryBuilder();
            $queryBuilder
                ->select('documentId, name, GROUP_CONCAT(data ORDER BY name ASC SEPARATOR " ") as text')
                ->from('documents_elements')
                ->where('type = "input"')
                ->orWhere('type = "wysiwyg"')
                ->andWhere('data LIKE :searchTerm AND name NOT LIKE "%.class"')
                ->setParameter('searchTerm', '%' . $query . '%')
                ->groupby('documentId');

            $results = $queryBuilder->execute()->fetchAll();
            $results = $this->prepareResults($results, $query);
        }

        return $results;
    }

    /**
     * Prepare results for output
     *
     * @param array $results
     * @param string $searchstring
     * @return array
     */
    protected function prepareResults(array $results = [], string $searchstring = ''): array
    {
        $preparedResults = [];

        foreach($results as $result) {
            $resultArray = [];
            $documentId = $result['documentId'];
            $document = Document::getById($documentId);

            if ($document && $document->getType() === 'page') {
                $fullText = $this->sanitizeText($result['text']);

                $resultArray['document'] = $document;
                $resultArray['title'] = $document->getTitle();
                $resultArray['text'] = str_ireplace($searchstring, '<b>' . $searchstring . '</b>', $this->cropText($fullText, $searchstring));
                $resultArray['tstamp'] = $document->getModificationDate();
                $resultArray['path'] = $document->getPath() . $document->getKey();
                $resultArray['wordCnt'] = substr_count(strtolower($fullText), strtolower($searchstring));

                $preparedResults[] = $resultArray;
            }
        }

        // sort by word count
        if(sizeof($preparedResults) > 1) {
            usort($preparedResults, function($a, $b) {
                return $a['wordCnt'] < $b['wordCnt'];
            });
        }

        return $preparedResults;
    }

    /**
     * @param string $text
     * @return string
     */
    protected function sanitizeText(string $text = ''): string
    {
        // strip tags mit leerzeichen
        // schneller und sauberer als preg_replace('/<[^>]*>/i', ' ', $property)
        // falls z.b. inline javascript vorhanden ist
        $sanitizedText = str_replace('>', '> ', $text);
        $sanitizedText = strip_tags($sanitizedText);

        // control characters entfernen
        $sanitizedText = preg_replace('/([\s\n\r\t]+)/', ' ', $sanitizedText);

        // doppelte leerzeichen entfernen
        $sanitizedText = preg_replace('/ {2,}/', ' ', $sanitizedText);
        $sanitizedText = trim($sanitizedText);

        return $sanitizedText;
    }

    /**
     * @param string $text
     * @param string $searchterm
     * @return string
     */
    protected function cropText(string $text = '', string $searchterm = ''): string
    {
        $textLength = strlen($text);
        $parts = [];
        $cropKeys = [];
        $croppedText = '';

        $cropLength = 400; // TODO: evtl. noch die folgenden variablen in config variablen auslagern
        $cropTolerance = 20;
        $cropPostPreLength = 30;
        $cropAppend = '...';

        if($textLength > $cropLength) {
            $diff = $textLength - $cropLength;
            $substrLength = 0;

            $parts = preg_split('/(' . $searchterm . ')/i', $text, null, PREG_SPLIT_DELIM_CAPTURE);

            // find out keys to crop
            foreach($parts as $key => $val) {
                // nur strings croppen, die lang genug sind
                if(strlen($val) > $cropPostPreLength * 2) {
                    $cropKeys[] = array('key' => $key);
                    $substrLength += strlen($val);
                }
            }

            // croppen
            foreach($cropKeys as $val) {
                $partLength = strlen($parts[$val['key']]);

                $partCrop = round(($partLength / $substrLength) * $diff);


                if(($partCrop + ($cropPostPreLength * 2)) > $partLength)
                    $partCrop = $partLength - ($cropPostPreLength * 2);

                $start = round(($partLength - $partCrop) / 2);

                // wenn letzter part, nur am ende croppen, sonst in der mitte
                if($val['key'] == (sizeof($parts) - 1)) {
                    $startString = substr($parts[$val['key']], 0, -1 * $partCrop);
                    $endString = '';
                } else {
                    $startString = substr($parts[$val['key']], 0, $start + 1);
                    $endString = substr($parts[$val['key']], ($start + $partCrop - 1));
                }

                $startString = substr($startString, 0, strrpos($startString, ' '));
                $endString = substr($endString, strpos($endString, ' '));

                $parts[$val['key']] = $startString . ' ' . $cropAppend . ' ' . $endString;
            }

            $croppedText = implode('', $parts);
            // doppelte leerzeichen entfernen
            $croppedText = preg_replace('/ {2,}/', ' ', $croppedText);

            // wenn trotzdem länger als toleranz
            if(strlen($croppedText) > ($cropLength + $cropTolerance)) {
                $croppedText = substr($croppedText, 0, $cropLength + $cropTolerance + 1);
                $croppedText = substr($croppedText, 0, strrpos($croppedText, ' ')) . $cropAppend;
            }
        }

        $croppedText = trim($croppedText);

        // satz- und sonderzeichen am anfang des textes entfernen
        $firstChar = substr($croppedText, 0, 1);
        if($firstChar && preg_match('/[^a-zA-Z0-9_äöüÄÖÜ]/', $firstChar))
            $croppedText = trim(substr($croppedText, 1));

        return $croppedText;
    }
}
