<?php
namespace Pluswerk\Simpleblog\Service;

class GoogleAutocompleteApiService implements \TYPO3\CMS\Core\SingletonInterface
{

    /**
     * @param mixed $object
     * @param string $property
     * @return array
     */
    public function validateData($object,$property)
    {
        $errors     = array();
        // Get value from property
        $getter     = 'get'.ucfirst($property);
        $getValue   = strtolower($object->$getter());
        // URL to ask for autocomplete suggestions
        $url = 'http://www.google.com/complete/search?output=firefox&q=' . urlencode($getValue);
        $result = json_decode(utf8_encode(file_get_contents($url)));

        // check if either no result or the property value is not in the suggestions
        if (empty($result[1]) || array_search($getValue,$result[1]) === FALSE) {
            $errors[$property] = 'No autocomplete entry for <strong>'.$getValue.'</strong>';
            // Add autocompletion values (if there are any)
            if (!empty($result[1])) {
                $errors[$property] .= ' (possible values are: ' . implode(', ', $result[1]) . ')';
            }
        }
        return $errors;
    }

}