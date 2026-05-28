<?php
/**
 * Section close helper of the Wrap Plugin
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Michael Hamann <michael@content-space.de>
 */

if (!defined('DOKU_INC')) die();

class syntax_plugin_wrap_closesection extends DokuWiki_Syntax_Plugin {

    public function getType() { return 'substition'; }
    public function getPType() { return 'block'; }
    public function getSort() { return 195; }

    /**
     * Dummy handler — this syntax part has no syntax; it is added directly by the div syntax
     *
     * @param string       $match
     * @param int          $state
     * @param int          $pos
     * @param Doku_Handler $handler
     * @return void
     */
    public function handle($match, $state, $pos, Doku_Handler $handler) {
    }

    /**
     * Create output
     *
     * @param string        $format
     * @param Doku_Renderer $renderer
     * @param mixed         $data
     * @return bool
     */
    public function render($format, Doku_Renderer $renderer, $data) {
        if ($format == 'xhtml') {
            /** @var Doku_Renderer_xhtml $renderer */
            $renderer->finishSectionEdit();
            return true;
        }
        return false;
    }
}
