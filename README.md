<div align="center" id="top"> 
  <img src="./assets/icon.svg" alt="Deb Dumper" />

  &#xa0;

</div>

<h1 align="center">Deb Dumper</h1>

<div align="center">
  <img alt="Github top language" src="https://img.shields.io/github/languages/top/AbelardoR/deb-dumper?color=56BEB8">

  <img alt="Github language count" src="https://img.shields.io/github/languages/count/AbelardoR/deb-dumper?color=56BEB8">

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/AbelardoR/deb-dumper?color=56BEB8">

  <img alt="License" src="https://img.shields.io/github/license/AbelardoR/deb-dumper?color=56BEB8">

</div>

## About ##

A plugin that provides a dump function to display the contents of output variables in a readable format to aid development.

## Features ##

The `dump` function provides a convenient way to output variable contents in a readable format, with optional customization via the $print argument.

The `dump` function takes two parameters:
  * `$code` the variable to be dumped (i.e., its contents will be output)
  * `$print` an optional boolean argument that defaults to false

The function creates a string that will wrap the output. It consists of:
  * A `<code>` tag with a class of "dump"
  * A `<span>` tag with a class that corresponds to the type of the $code variable (e.g., "string", "array", "object", etc.)

Outputting the variable contents
the contents of the `$code` variable. The output method depends on the value of `$print`:

If `$print` is true, the function uses `print_r()` to output the variable contents in a human-readable format.
If `$print` is false (default), the function uses `var_dump()` to output the variable contents in a more detailed, debug-oriented format.

## Technologies ##

The following tools were used in this project:

- [vscode](https://code.visualstudio.com/)
- [WordPress dev](https://developer.wordpress.org/)
- [PHP](https://www.php.net/)

## Starting ##

```bash
# Clone this project
git clone https://github.com/AbelardoR/template-info

- Upload the project folder to the "/wp-content/plugins/ directory"

- Go to "Plugins" menu in WordPress

- Activate the Deb Dumper Plugin 

```
## Example usage ##
```php
dump($myArray); // outputs the contents of $myArray in a formatted way
dump($myObject, true); // outputs the contents of $myObject using print_r()
```
## License ##

This project is under license from GNU Version 3. For more details, see the [LICENSE](LICENSE.md) file.


Made with :heart: by <a href="https://github.com/AbelardoR" target="_blank">Abelardo R.</a>

&#xa0;

<a href="#top">Back to top</a>