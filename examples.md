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

## If Statement

given the following code

```js
let studentGrade = 80;
if (studentGrade > 75) {
    console.log("Congratulations! You have passed the final assessment.");
}
```

to check for the if statement

```js
$if = $js->find('if-statement');
$test = $if->getSubNode('test'); // we test the 'test' subnode first
$binary = $test->find('binary-expression[operator=">"]'); // Check if it uses a binary expression to evaluate the if statement.
$left = $binary->getSubNode('left'); // Let's check the left side of the binary expression
$var = $left->find('identifier[name="studentGrade"]'); // $var should give us a single node if it matches
$right = $binary->getSubNode('right'); // Let's check the right side of the binary expression
$literal = $right->find('literal[value="75"]');

$consequent = $if->getSubNode('consequent'); // Get the consequent node of if statement
$body = $consequent->getSubNode('body'); // Get the body node

$console = $body->find('call-expression[name="console", property="log"]');
$args = $console->getSubNode('arguments');
$literal = $args->find('literal[value="Congratulations! You have passed the final assessment"]');
```

With an else statement

```js
let studentGrade = 80;
if (studentGrade > 75) {
    console.log("Congratulations! You have passed the final assessment.");
} else {
    console.log("Sorry! Try again.");
}
```

To get check the else statement

```js
$if = $js->find('if-statement');
$alternate = $if->getSubNode('alternate');
$body = $alternate->getSubNode('body');
$console = $body->find('call-expression[name="console", property="log"]');
$args = $console->getSubNode('arguments');
$literal = $args->find('literal[value="Sorry! Try again."]');
```

With else if statement

```js
let studentGrade = 80;
if (studentGrade > 75) {
    console.log("Congratulations! You have passed the final assessment.");
} else if (studentGrade < 75) {
    console.log("Sorry! Try again.");
} else {
    console.log("You made it! Let's celebrate!");
}
```

```js
$if = $js->find('if-statement');
$alternate = $if->getSubNode('alternate');
$test = $alternate->getSubNode('test'); // Checking the test node
$consequent = $alternate->getSubNode('consequent'); // The else if statement body block
$consBody = $consequent->getSubNode('body'); // The actual body of the else if statement
$alternate = $alternate->getSubNode('alternate'); // The else statement block.
```

## Switch Statement

Given this switch code

```js
let studentGrade = 'C';

switch (studentGrade) {
    case 'A':
        remarks = "Excellent";
        break;
    case 'B':
        remarks = "Very Good";
        break;
    case 'C':
        remarks = "Good";
        break;
    case 'D':
        remarks = "Needs Improvement";
        break;
    default:
        remarks = "Invalid input. Please try again.";
        break;
}
console.log("Your grade is: " + studentGrade + ". Remarks: " + remarks);
```

To check for the switch statements

```js
$switch = $js->find('switch'); // Give you the switch node
$cases = $switch->getSubNode('cases'); // Return all case statements 
$const = $cases->getSubNode('consequent'); // Will give you all case body
$test = $cases->getSubNode('test'); // Will give you all case test
$out = $test->find('literal[value="A"]'); // Testing if a test for a literal value 'A' is on the code
$default = $cases->find('switch-default'); // To get the default case.

// TO check for break statements.
$switch = $js->find('switch');
$cases = $switch->getSubNode('cases');
$const = $cases->getSubNode('consequent');
$const0 = $const->getSubIndex(0); // This will give us the first switch consequent statement ( body of the switch statement)
$br0 = $const0->find('break'); // Will give us the first break statement. 
```

## Arithmetic Operators

```js
let x = 10;
let y = 2;

let z = x + y;
z = x - y;
z = x * y;
z = x / y;
z = x % y;
```

TO check for arithmetic expression

```js
$plus = $js->find('binary-expression[operator="+"]');
$minus = $js->find('binary-expression[operator="-"]'); 
$multiply = $js->find('binary-expression[operator="*"]'); 
$division = $js->find('binary-expression[operator="/"]'); 
$modulo = $js->find('binary-expression[operator="%"]'); 
```

## For Loop

```js
for (let x = 1; x > 5; x++) {
    console.log(x);
}
```

```js
$for = $js->find('for-statement'); //Will give us the for loop node

$init = $for->getSubNode('init'); //Will give us the init node `let x = 1` above.
$test = $for->getSubNode('test'); // Will give us the test node `x > 5` above.
$update = $for->getSubNode('update'); // will give us the update node `x++` above.

$increment = $update->find('update-expression[operator="++"]'); // Will give us the node of using the increment operator

$args = $incremnt->getSubNode('argument');
$ident = $args->find('identifier[name="counter"]'); // Will give you the node if counter++ was use to increment the loop.

$body = $for->getSubNode('body'); // Give us the body node of the for loop.

```

## While Loop

```js
let counter = 0;
while (counter < 5) {
    console.log("Hello World!");
    counter++;
}
```

```php
$while = $js->find('while-statement'); // Will give us the while loop node.

$test = $while->getSubNode('test'); // Will give us the test node `counter < 5` above.
$body = $while->getSubNode('body'); // Will give us the body node of the while loop.
```

## Return and Continue

To get the `return` and `continue` node

```php
$return = $js->find('return');
$continue = $js->find('continue');
```

## Function Declaration

```js
function writeMessage(message) {
    console.log("Hello World!");	
}

writeMessage();
```

```php
$func = $js->find('function-declaration'); // Will give us all function declaration nodes.

$func = $js->find('function-declaration[name="writeMessage"]'); // Will only give us the function declaration whose function name is `writeMessage`.

$params = $func->getSubNode('params'); // Will give us the function signature parameters if one is given.
$body = $func->getSubNode('body'); // Will give us the function body.

$call = $js->find('call-expression[name="writeMessage"]'); // Will match the node that calls the function `writeMessage`
```

## Function Expression

```js
let message = function greeting() {
    console.log("Hello, world.");
};

message();
```

```php
$variable = $js->find('variable-declaration'); // We get the variable declaration node.
$declarations = $variable->getSubNode('declarations'); // We get the subnode that we needed
$init = $declarations->getSubNode('init'); // We get the init node since it's what we want to know if it's a function expression

$func = $init->find('function-expression'); // Will give us a function expression node.
$func = $init->find('function-expression[name="foo"]'); // Will give us a function expression node whose identifier is called `foo`.
```

## Arrow Function

```js
let takeOrder = () => {
  console.log("You order: pizza");
};

takeOrder();
```

```php
$variable = $js->find('variable-declaration'); // give us the variable declaration node.
$declarations = $variable->getSubNode('declarations'); // Will give us the declaration node of the variable
$init = $declarations->getSubNode('init'); // Will give us the init node.

$arrow = $init->find('arrow-function'); // Will give us the arrow function node.

$params = $arrow->getSubNode('params'); // Will give us the node of params.
$body = $arrow->getSubNode('body'); // Give us the body node of the arrow function.
```

## Built-in methods

```js
let number = 14.756335;
console.log(Math.round(number));
```

```php
$console = $js->find('call-expression[name="console", property="log"]'); // Will give us the console node.
$arguments = $console->getSubNode('arguments'); // Will give us the argument node of the console node.

$math = $arguments->find('call-expression[name="Math", property="round"]'); // Will give us the Math.round node.
```