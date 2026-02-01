<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

return (new Config())
    // risky = 挙動が変わる可能性のある変換を含むルールを許可する
    ->setRiskyAllowed(true)

    ->setRules([
        /**
         * ルールセット
         * - @PSR1/@PSR2: 基本的なPHPのコーディング規約（旧来の標準）
         * - @Symfony: PER-CS を拡張した規約セット（整形が広めにかかる）
         *
         * ※ @Symfony を使う場合、@PSR1/@PSR2 は包含されて冗長になることが多いが、
         *   「ベース規約を明示したい」意図で残す運用もある。
         */
        '@PSR1' => true,
        '@PSR2' => true,
        '@Symfony' => true,

        /**
         * PHPUnit のテストメソッド名の casing を強制するルール。
         * プロジェクトの命名規則（camelCase / snake_case など）と衝突しやすいので無効化。
         */
        'php_unit_method_casing' => false,

         /**
         * PHPDoc 系のルールは、IDE Helper 生成DocBlockや既存DocBlockと衝突して
         * 差分が増えやすい項目があるため、整形を抑制する意図で無効化。
         */
        'phpdoc_summary' => false,       // summary 行の強制
        'phpdoc_align' => false,         // タグの縦揃え
        'phpdoc_separation' => false,    // ブロック内の空行/分離
        'phpdoc_no_alias_tag' => false,  // タグ別名の正規化（例: type→var 等）
        'phpdoc_to_comment' => false,    // PHPDoc を通常コメントに変換

        /**
         * IDE Helper が生成する DocBlock を保護するための設定。
         * phpdoc_trim が有効だと、生成された PHPDoc が削られたり形が変わって差分が出続けることがある。
         */
        'phpdoc_trim' => false,

        'no_trailing_whitespace_in_comment' => false,

        /**
         * phpdoc_tags を空にしているのは IDE Helper 対策：
         * PHPDoc(@property 等)まで FQCN 変換が走ると DocBlock が大きく変わりがちなので対象外にする。
         */
        'fully_qualified_strict_types' => [
            'import_symbols' => true,
            'phpdoc_tags' => [],
        ],
    ])

    ->setFinder(
        Finder::create()
            ->in(__DIR__ . '/app')
            ->in(__DIR__ . '/tests')
            ->in(__DIR__ . '/database')
    )
;
