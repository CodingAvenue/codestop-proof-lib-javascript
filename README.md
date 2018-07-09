# CodeStop Javascript Proof Library

## Usage

### Basic

`$js = new JS('/path/to/your/JS/code');`

### SubNodes

Sometimes you may just want to start searching from a subnode directly, To do that just call `getSubNode` method, pass the subnode name that you want to process only.

```js

$call = $js->find('call-expression');
$call->getSubnode('arguments'); // Will give you a new Nodes instance with just the argument subnode on it.
```

### Console

```js
$node = $js->find('call-expression[name="console"]'); // Will match any console.log() console.error() calls

$node = $js->find('call-expression[name="console", property="log"]'); // will match console.log() only.

// To search for what was passed to console.log you will need to do a new find() after the call-expression find.

$consoleNode = $js->find('call-expression[name="console", property="log"]');
$consoleNode->find('argument[type="IDENTIFIER", name="x"]'); // Will match console.log(x);
$consoleNode->find('argument[type="LITERAL", value="x"]'); // Will match console.log('x');

```

### Variable

```js
$node = $js->find('variable[name="name"]'); // WIll match variable declaration for variable 'name' e.g. let name = 'jerome';
$node = $js->find('variable[name="name", kind="let"]'); // WIll match variable declaration for variable 'name' using the let keyword.
$node = $js->find('variable[name="name", initType="literal", "initValue="hello"]'); // Will match variable `let name = 'hello'`
```

### Argument with String Operator

```js
$consoleNode = $js->find('call-expression[name="console", property="log"]');
$consoleNode->find('binary-expression[name="+", leftType="literal", leftValue="hello"'); //Will match `console.log('hello' + 'there'); 
// YOu can specify both the right hand or the left hand side of the operator
// Supported attributes are 
// - leftType - type of the left hand side ( literal or identifier )
// - leftName - the name of the identifier, if type is identifier
// - leftValue - the value if the type is literal
// Just change left to right and it will look at the right hand side.
```

### Variable declaration with binary operator

```js
$variableNode = $js->find('variable[name="index", initType="binaryexpression"]');
$variableNode->find('binary-expression[name="+", leftValue="12", rightValue="23"]'); // Will match let index = 12 + 23; 
```

### If Statement

```js
$if = $js->find('if-statement'); // It will now return all if statement nodes.

// To know what was testd and the body of the if statement, use the `getSubnode()` to get each subnode and search from their.

$test = $if->getSubnode('test'); // WIll give us the test node only. The node that evaluates.
$test->find('binary-expression[name=">", leftValue="12", rightValue="23"]'); // Will match if (12 > 23) statement.
// To go to the else or else if statement just do `$if->getSubnode('consequent')`
```

### Switch Statement

```js
$swtich = $js->find('switch'); // Will return all switch statement nodes.

//To check what is being evaluated get the `discrimant` subnode
$discriminant = $switch->getSubNode('disriminant');
// If you expecting a variable foo then you can do this
$discriminant->find('variable[name="foo"]');

// TO check for the cases get the `cases` sub node
$cases = $switch->getSubNode('cases');
// Each element of the `$cases` will have a `test` and `consequent` subnode like the `if` statement.
```

