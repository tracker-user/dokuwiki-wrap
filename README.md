# Wrap plugin for DokuWiki — local fork

Based on the [Wrap Plugin](https://www.dokuwiki.org/plugin:wrap) by Anika Henke.
Original source: https://github.com/selfthinker/dokuwiki_plugin_wrap

## New toolbar buttons

Seven buttons have been added to the toolbar picker beyond the original set:

| Button | Class | Element | Effect |
|---|---|---|---|
| center align | `centeralign` | `<WRAP>` (div) | Centers text and headings within the block |
| right align | `rightalign` | `<WRAP>` (div) | Right-aligns text and headings |
| justify | `justify` | `<WRAP>` (div) | Justifies text |
| spoiler | `spoiler` | `<wrap>` (span) | White-on-white text, revealed by highlighting |
| indent | `indent` | `<WRAP>` (div) | Indents a paragraph by 1.5em |
| tabs | `tabs` | `<WRAP>` (div) | Renders a list of links as tabs |
| button | `button` | `<wrap>` (span) | Styles a link to look like a button |

**Note:** alignment classes (`centeralign`, `rightalign`, `justify`) only work on block-level `<WRAP>` tags, not inline `<wrap>` spans. To center a heading, wrap the entire heading line:

```
<WRAP centeralign>
====== My Centered Heading ======
</WRAP>
```

## Code changes (this fork)

### PHP modernization

- **DOKU_INC guards** added to all logic files: `action.php`, `helper.php`, `syntax/div.php`, `syntax/span.php`, `syntax/spaninline.php`, `syntax/spanwrap.php`, `syntax/closesection.php`
- **Explicit visibility** (`public`/`protected`) added to every method across all files
- **Array syntax** modernized from `array()` to `[]` throughout
- **Destructuring** updated from `list($a, $b)` to `[$a, $b]` in `render()` methods
- **`str_contains()`** replaces `strpos() !== false` patterns in `helper.php` (PHP 8.0+)
- **`!empty()`** replaces `empty() === false` patterns in `helper.php`
- **Property declaration order** corrected from `static protected` to `protected static`
- **Docblocks** added to all `renderODT*` methods in `helper.php`

### Translations

New toolbar button strings added to: `en`, `de`, `de-informal`, `ru`, `ja`.

### plugin.info.txt

- Date updated to `2077-08-13` per local fork convention
- `TrackerUser` added to the author field
- Removed stray `#syntax` comment
