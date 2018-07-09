# Examples

## Console.log

Checking if a code has `console.log('hello World');`

```js
$console = $js->find('call-expression[name="console", property="log"]');
$args = $console->getSubNode('arguments');
$literal = $args->find('literal[value="hello World"]');
```

`$literal` should give you a single array element if a match is found. If not, then it's an empty array.

## Variable

checking if a code has `let firstName = "charles";`

```js
$variable = $js->find('variable-declaration');
$declarations = $variable->getSubNode('declarations');
$ident = $declarations->find('identifier[name="firstName"]');
$initValue = $ident->getSubNode('init');
$literal = $initValue->find('literal[value="charles"]');
```

`$literal` should give you a single array element.

## Using variable as arguments

checking `console.log(firstName);` where `firstName` is a variable

```js
$console = $js->find('call-expression[name="console", property="log"]');
$args = $console->getSubNode('arguments');
$ident = $args->find('identifier[name="firstName"]');
```

`$ident` should give you the node of the `firstName` variable as the argument.

## Assignments Expression

given the following code

```js
let firstName;
firstName = "Charles";
```

To test for an assignment node

```js
$assignment = $js->find('assignment-expression');
//Or
$assignment = $js->find('assignment-expression[operator="="]'); // Operator attribute is the opertor use on the assignment.
$left = $assignment->getSubNode('left');
$left->find('identifier[name="firstName"]'); // Should give you the node of the firstName variable

$right = $assignment->getSubNode('right');
$right->find('literal[value="Charles"]');
```

## String Concatenation

given the following code

```js
let message = "Good Morning!";
console.log(message + " I am Diana Rose.");
```

To find if the arguments on `console.log` is a string concatenation

```js
$console = $js->find('call-expression[name="console", property="log"]');
$args = $console->getSubNode('arguments');
$exp = $args->find('binary-expression[name="+"]'); // Check if there is a binary expression on the argument that uses the "+" operator
$left = $exp->getSubNode('left');
$message = $left->find('identifier[name="message"]');
$right = $exp->getSubNode('right');
$literal = $right->find('literal[value=" I am Diana Rose."]');
```