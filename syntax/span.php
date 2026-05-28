<?php
/**
 * Span Syntax Component of the Wrap Plugin
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Anika Henke <anika@selfthinker.org>
 */

if (!defined('DOKU_INC')) die();

class syntax_plugin_wrap_span extends DokuWiki_Syntax_Plugin {
    protected $special_pattern = '<span\b[^>\r\n]*?/>';
    protected $entry_pattern   = '<span\b.*?>(?=.*?</span>)';
    protected $exit_pattern    = '</span>';

    public function getType() { return 'formatting'; }
    public function getAllowedTypes() { return ['formatting', 'substition', 'disabled']; }
    public function getPType() { return 'normal'; }
    public function getSort() { return 195; }

    /** Override default accepts() to allow nesting */
    public function accepts($mode) {
        if ($mode == substr(get_class($this), 7)) return true;
        return parent::accepts($mode);
    }

    /**
     * Connect pattern to lexer
     *
     * @param string $mode
     * @return void
     */
    public function connectTo($mode) {
        $this->Lexer->addSpecialPattern($this->special_pattern, $mode, 'plugin_wrap_'.$this->getPluginComponent());
        $this->Lexer->addEntryPattern($this->entry_pattern, $mode, 'plugin_wrap_'.$this->getPluginComponent());
    }

    /**
     * @return void
     */
    public function postConnect() {
        $this->Lexer->addExitPattern($this->exit_pattern, 'plugin_wrap_'.$this->getPluginComponent());
    }

    /**
     * Handle the match
     *
     * @param string       $match
     * @param int          $state
     * @param int          $pos
     * @param Doku_Handler $handler
     * @return array|false
     */
    public function handle($match, $state, $pos, Doku_Handler $handler) {
        switch ($state) {
            case DOKU_LEXER_ENTER:
            case DOKU_LEXER_SPECIAL:
                $data = strtolower(trim(substr($match, strpos($match, ' '), -1), " \t\n/"));
                return [$state, $data];

            case DOKU_LEXER_UNMATCHED:
                $handler->addCall('cdata', [$match], $pos);
                return false;

            case DOKU_LEXER_EXIT:
                return [$state, ''];
        }
        return false;
    }

    /**
     * Create output
     *
     * @param string        $format
     * @param Doku_Renderer $renderer
     * @param array         $indata
     * @return bool
     */
    public function render($format, Doku_Renderer $renderer, $indata) {
        static $type_stack = [];

        if (empty($indata)) return false;
        [$state, $data] = $indata;

        if ($format == 'xhtml') {
            switch ($state) {
                case DOKU_LEXER_ENTER:
                case DOKU_LEXER_SPECIAL:
                    $wrap = $this->loadHelper('wrap');
                    $attr = $wrap->buildAttributes($data);

                    $renderer->doc .= '<span'.$attr.'>';
                    if ($state == DOKU_LEXER_SPECIAL) $renderer->doc .= '</span>';
                    break;

                case DOKU_LEXER_EXIT:
                    $renderer->doc .= '</span>';
                    break;
            }
            return true;
        }
        if ($format == 'odt') {
            switch ($state) {
                case DOKU_LEXER_ENTER:
                    $wrap = plugin_load('helper', 'wrap');
                    array_push($type_stack, $wrap->renderODTElementOpen($renderer, 'span', $data));
                    break;

                case DOKU_LEXER_EXIT:
                    $element = array_pop($type_stack);
                    $wrap    = plugin_load('helper', 'wrap');
                    $wrap->renderODTElementClose($renderer, $element);
                    break;
            }
            return true;
        }
        return false;
    }
}
