# CodeStop Javascript Proof Library

## Usage

### Basic

`$js = new JS('/path/to/your/JS/code');`

### Finding Console

```js
$node = $js->find('call-expression[name="console"]'); // Will match any console.log() console.error() calls

$node = $js->find('call-expression[name="console", property="log"]'); // will match console.log() only.

// To search for what was passed to console.log you will need to do a new find() after the call-expression find.

$consoleNode = $js->find('call-expression[name="console", property="log"]');
$consoleNode->find('argument[type="IDENTIFIER", name="x"]'); // Will match console.log(x);
$consoleNode->find('argument[type="LITERAL", value="x"]'); // Will match console.log('x');

```

