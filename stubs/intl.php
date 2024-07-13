<?php
class MessageFormatter {

  public function __construct(string $locale, string $pattern){}
  public static function create(string $locale, string $pattern): ?MessageFormatter {}
  public static function formatMessage(string $locale, string $pattern, array $values): string|false {}
  public function format(array $values): string|false {}
  public function getErrorCode(): int {}
  public function getErrorMessage(): string {}
  public function getLocale(): string {}
  public function getPattern(): string|false {}
  public static function parseMessage(string $locale, string $pattern, string $message): array|false {}
  public function parse(string $string): array|false {}
  public function setPattern(string $pattern): bool {}
}
