<?php
/**
 * Action Component for the Wrap Plugin
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Andreas Gohr <andi@splitbrain.org>
 */

if (!defined('DOKU_INC')) die();

class action_plugin_wrap extends DokuWiki_Action_Plugin {

    /**
     * Register the eventhandlers
     *
     * @param Doku_Event_Handler $controller
     * @return void
     */
    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'handle_toolbar', []);
        $controller->register_hook('HTML_SECEDIT_BUTTON', 'BEFORE', $this, 'handle_secedit_button');
    }

    /**
     * Add wrap picker to the editor toolbar
     *
     * @param Doku_Event $event
     * @param mixed      $param
     * @return void
     */
    public function handle_toolbar(Doku_Event $event, $param) {
        $syntaxDiv  = $this->getConf('syntaxDiv');
        $syntaxSpan = $this->getConf('syntaxSpan');

        $event->data[] = [
            'type'  => 'picker',
            'title' => $this->getLang('picker'),
            'icon'  => '../../plugins/wrap/images/toolbar/picker.png',
            'list'  => [
                [
                    'type'  => 'format',
                    'title' => $this->getLang('indent'),
                    'icon'  => '../../plugins/wrap/images/toolbar/indent.png',
                    'open'  => '<'.$syntaxDiv.' indent>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('centeralign'),
                    'icon'  => '../../plugins/wrap/images/toolbar/centeralign.png',
                    'open'  => '<'.$syntaxDiv.' centeralign>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('rightalign'),
                    'icon'  => '../../plugins/wrap/images/toolbar/rightalign.png',
                    'open'  => '<'.$syntaxDiv.' rightalign>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('justify'),
                    'icon'  => '../../plugins/wrap/images/toolbar/justify.png',
                    'open'  => '<'.$syntaxDiv.' justify>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('spoiler'),
                    'icon'  => '../../plugins/wrap/images/toolbar/spoiler.png',
                    'open'  => '<'.$syntaxSpan.' spoiler>',
                    'close' => '</'.$syntaxSpan.'>',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('column'),
                    'icon'  => '../../plugins/wrap/images/toolbar/column.png',
                    'open'  => '<'.$syntaxDiv.' group>\n<'.$syntaxDiv.' half column>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n\n<'.$syntaxDiv.' half column>\n\n</'.$syntaxDiv.'>\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('box'),
                    'icon'  => '../../plugins/wrap/images/toolbar/box.png',
                    'open'  => '<'.$syntaxDiv.' center round box 60%>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('info'),
                    'icon'  => '../../plugins/wrap/images/note/16/info.png',
                    'open'  => '<'.$syntaxDiv.' center round info 60%>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('tip'),
                    'icon'  => '../../plugins/wrap/images/note/16/tip.png',
                    'open'  => '<'.$syntaxDiv.' center round tip 60%>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('important'),
                    'icon'  => '../../plugins/wrap/images/note/16/important.png',
                    'open'  => '<'.$syntaxDiv.' center round important 60%>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('alert'),
                    'icon'  => '../../plugins/wrap/images/note/16/alert.png',
                    'open'  => '<'.$syntaxDiv.' center round alert 60%>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('help'),
                    'icon'  => '../../plugins/wrap/images/note/16/help.png',
                    'open'  => '<'.$syntaxDiv.' center round help 60%>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('download'),
                    'icon'  => '../../plugins/wrap/images/note/16/download.png',
                    'open'  => '<'.$syntaxDiv.' center round download 60%>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('todo'),
                    'icon'  => '../../plugins/wrap/images/note/16/todo.png',
                    'open'  => '<'.$syntaxDiv.' center round todo 60%>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'   => 'insert',
                    'title'  => $this->getLang('clear'),
                    'icon'   => '../../plugins/wrap/images/toolbar/clear.png',
                    'insert' => '<'.$syntaxDiv.' clear/>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('em'),
                    'icon'  => '../../plugins/wrap/images/toolbar/em.png',
                    'open'  => '<'.$syntaxSpan.' em>',
                    'close' => '</'.$syntaxSpan.'>',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('hi'),
                    'icon'  => '../../plugins/wrap/images/toolbar/hi.png',
                    'open'  => '<'.$syntaxSpan.' hi>',
                    'close' => '</'.$syntaxSpan.'>',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('lo'),
                    'icon'  => '../../plugins/wrap/images/toolbar/lo.png',
                    'open'  => '<'.$syntaxSpan.' lo>',
                    'close' => '</'.$syntaxSpan.'>',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('tabs'),
                    'icon'  => '../../plugins/wrap/images/toolbar/tabs.png',
                    'open'  => '<'.$syntaxDiv.' tabs>\n',
                    'close' => '\n</'.$syntaxDiv.'>\n',
                ],
                [
                    'type'  => 'format',
                    'title' => $this->getLang('button'),
                    'icon'  => '../../plugins/wrap/images/toolbar/button.png',
                    'open'  => '<'.$syntaxSpan.' button>',
                    'close' => '</'.$syntaxSpan.'>',
                ],
            ],
        ];
    }

    /**
     * Handle section edit buttons, prevents section buttons inside the wrap plugin from being rendered
     *
     * @param Doku_Event $event The event object
     * @param array      $param Parameters for the event
     * @return void
     */
    public function handle_secedit_button(Doku_Event $event, $param) {
        static $wraps = 0;
        $data = $event->data;

        if ($data['target'] == 'plugin_wrap_start') {
            ++$wraps;
        } elseif ($data['target'] == 'plugin_wrap_end') {
            --$wraps;
        } elseif ($wraps > 0 && $data['target'] == 'section') {
            $event->preventDefault();
            $event->stopPropagation();
            $event->result = '';
        }
    }
}
