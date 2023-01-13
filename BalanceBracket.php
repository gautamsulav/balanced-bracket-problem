<?php

/**
 *  Stack data structure implementation using array
 */
class Stack {
    private int $top;
    public array $stack = [];
    const STACK_SIZE = 100;

    function __construct() {
        $this->top = -1;
    }

    public function isEmpty(): bool
    {
        return $this->top > -1;
    }

    public function size(): int
    {
        return $this->top + 1;
    }

    public function top(): mixed
    {
        if($this->top == -1){
            return false;
        }

        return $this->stack[$this->top];
    }

    public function push($element): bool
    {
        if($this->top >= Stack::STACK_SIZE-1) {
            return false;
        }

        $this->stack[++$this->top] = $element;
        return true;
    }

    public function pop(): mixed
    {
        if($this->top == -1) {
            return false;
        }
        return $this->stack[$this->top--];
    }

    // print stack array
    /*public function printStack(): bool|string
    {
        if ($this->top == -1) {
            return 'Stack is empty';
        }
        return print_r($this->stack, true);
    }*/
}

/**
 * Solution to balanced bracket problem.
 * i.e for a given string determine if for every open bracket
 * there is a closing bracket in the reverse order
 *
 * @param $input
 * @return bool|int|string
 */
function balancedBracket($input): bool|int|string
{
    if(strlen($input) == 0) {
        return 'Empty String';
    }

    $chars = str_split($input);
    $isNotBalanced = false;
    $stack = new Stack();

    foreach ($chars as $char) {
        switch($char) {
            case '{':
            case '[':
            case '(':
                $stack->push($char);
                break;

            case '}':
                if($stack->pop() !== '{') {
                    $isNotBalanced = true;
                }
                break;

            case ']':
                if($stack->pop() !== '[') {
                    $isNotBalanced = true;
                }
                break;

            case ')':
                if($stack->pop() !== '(') {
                    $isNotBalanced = true;
                }
                break;

            default:
                break;
        }
    }

    return $isNotBalanced ? 'Not Balanced' : ($stack->size() ? 'Not Balanced' : 'Balanced');
}

//sample input and output
$input = '{{}}'; // balanced
echo balancedBracket($input) . PHP_EOL;

$input = '[{()}]'; // balanced
echo balancedBracket($input) . PHP_EOL;

$input = '{[)]}'; // not balanced
echo balancedBracket($input) . PHP_EOL;

$input = ''; // empty string
echo balancedBracket($input) . PHP_EOL;

$input = '123{}[]'; // balanced
echo balancedBracket($input) . PHP_EOL;

$input = '123{}[]('; // not balanced
echo balancedBracket($input) . PHP_EOL;
