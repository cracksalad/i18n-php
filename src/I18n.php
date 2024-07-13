<?php
declare(strict_types=1);

namespace Cracksalad\I18n;

use Gettext\Translation;
use Gettext\Translations;
use Gettext\Loader\MoLoader;

/**
 * @author Andreas Wahlen
 */
class I18n implements \JsonSerializable {

  private string $locale;
  private Translations $translations;
  
  /**
   * @throws \InvalidArgumentException if the translation .mo file could not be found or read.
   */
  public function __construct(string $locale, string $domain = 'messages', string $directory = './locale') {
    $this->locale = $locale;
    
    $realpath = \realpath($directory);
    if($realpath === false){
      throw new \InvalidArgumentException($directory.' does not exist or is not readable');
    }
    $path = $realpath.DIRECTORY_SEPARATOR.$locale.DIRECTORY_SEPARATOR.'LC_MESSAGES'.DIRECTORY_SEPARATOR.$domain.'.mo';
    if(!is_file($path) || !is_readable($path)){
      throw new \InvalidArgumentException($path.' does not exist or is not readable');
    }
    
    $loader = new MoLoader();
    $this->translations = $loader->loadFile($path);
  }
  
  public function jsonSerialize(): array {
    return [
      'locale' => $this->locale,
      'translations' => $this->translations->toArray()
    ];
  }
  
  public function _(string $original, ?string $context = null): string {
    return $this->getTranslation($original, $context)?->getTranslation() ?? $original;
  }
  
  public function _f(string $original, string|int|float ...$replacements): string {
    return sprintf($this->_($original), ...$replacements);
  }
  
  public function _fe(string $original, string|int|float ...$replacements): string {
    return $this->formatMessage($this->_($original), ...$replacements);
  }
  
  public function _p(string $original, string $plural, int $count): string {
    $translation = $this->getTranslation($original);
    if($translation === null){
      return $count === 1 ? $original : $plural;
    }
    return $count === 1 ? ($translation->getTranslation() ?? $original) : ($translation->getPlural() ?? $plural);
  }
  
  public function _pf(string $original, string $plural, int $count, string|int|float ...$replacements): string {
    array_unshift($replacements, $count);
    return sprintf($this->_p($original, $plural, $count), ...$replacements);
  }
  
  public function _pfe(string $original, string $plural, int $count, string|int|float ...$replacements): string {
    return $this->formatMessage($this->_p($original, $plural, $count), ...$replacements);
  }
  
  private function getTranslation(string $original, ?string $context = null): ?Translation {
    return $this->translations->find($context, $original);
  }
  
  /**
   * @throws \InvalidArgumentException if $pattern could not be handled by MessageFormatter::format()
   */
  private function formatMessage(string $pattern, string|int|float ...$replacements): string {
    $formatter = new \MessageFormatter($this->locale, $pattern);
    $formatted = $formatter->format($replacements);
    if($formatted === false){
      throw new \InvalidArgumentException($formatter->getErrorMessage(), $formatter->getErrorCode());
    }
    return $formatted;
  }
}
