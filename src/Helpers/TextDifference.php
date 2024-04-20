<?php

namespace Yormy\CoreToolsLaravel\Helpers;

class TextDifference
{
    /**
     * @param array $previous
     * @param array $current
     * @return array
     */
    public static function getDiffArray(array $previous, array $current): array
    {
        $diff = array();

        foreach (array_keys($previous) as $field) {
            $diff[$field] = self::getDiff($previous[$field], $current[$field]);
        }

        return $diff;
    }

    /**
     * @param string $previous
     * @param string $current
     * @return string
     */
    public static function getDiff(?string $previous, string $current): string
    {
        $diff = TextDifference::htmlDiff($previous, $current);
        $tagsStripped = strip_tags($diff, '<del><ins>');

        $tagsStripped = str_replace("<del></del>", "", $tagsStripped);
        $tagsStripped = trim($tagsStripped);
        return $tagsStripped;
    }


    /**
     * @param $old
     * @param $new
     * @return string
     */
    protected static function htmlDiff($old, $new)
    {
        $ret = '';
        $diff = self::diffElements(explode(' ', $old), explode(' ', $new));
        foreach ($diff as $k) {
            if (is_array($k)) {
                $ret .= (!empty($k['d']) ? '<del>' . implode(' ', $k['d']) . '</del> ' : '') . (!empty($k['i']) ? '<ins>' . implode(' ', $k['i']) . '</ins> ' : '');
            } else {
                $ret .= $k . ' ';
            }
        }
        return strip_tags($ret, '<del><ins>');;
    }


    /**
     * @param $old
     * @param $new
     * @return array|array[]
     */
    protected static function diffElements($old, $new)
    {
        $matrix = array();
        $maxlen = 0;
        foreach ($old as $oindex => $ovalue) {
            $nkeys = array_keys($new, $ovalue);
            foreach ($nkeys as $nindex) {
                $matrix[$oindex][$nindex] = isset($matrix[$oindex - 1][$nindex - 1]) ? $matrix[$oindex - 1][$nindex - 1] + 1 : 1;
                if ($matrix[$oindex][$nindex] > $maxlen) {
                    $maxlen = $matrix[$oindex][$nindex];
                    $omax = $oindex + 1 - $maxlen;
                    $nmax = $nindex + 1 - $maxlen;
                }
            }
        }
        if ($maxlen == 0) {
            return array(array('d' => $old, 'i' => $new));
        }
        return array_merge(
            self::diffElements(array_slice($old, 0, $omax), array_slice($new, 0, $nmax)),
            array_slice($new, $nmax, $maxlen),
            self::diffElements(array_slice($old, $omax + $maxlen), array_slice($new, $nmax + $maxlen))
        );
    }
}
