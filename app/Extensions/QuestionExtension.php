<?php


namespace App\Extensions;


use App\Model\Question;
use Parsedown;

class QuestionExtension extends Parsedown
{

    /** @var Question[] $questions */
    private $questions;
    function __construct($questions)
    {
        $this->InlineTypes['{'][]= 'questions';

        $this->inlineMarkerList .= '{';

        $this->questions = $questions;
    }

    protected function inlinequestions($excerpt)
    {
        if (preg_match('/^{question:(.*?)}/', $excerpt['text'], $matches))
        {
            return [
                'extent' => strlen($matches[0]),
                'element' => [
                    'name' => 'div',
                    'handler' => 'rawHtml',
                    'text' => $this->questions[$matches[1]]->toHtml(),
                ],

            ];
        }
    }
    protected function rawHtml($text)
    {
        return $text;
    }

}
