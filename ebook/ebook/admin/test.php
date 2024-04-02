<?php 

// require_once("../vendor/autoload.php");

// use Smalot\PdfParser\Parser;

// $parser = new Parser(); // Create a new instance of the parser
// $pdf = $parser->parseFile('../uploads/pdf/641ac48b920186.05412027.pdf'); // Parse the PDF file

// $text = $pdf->getText(); // Extract the text content from the PDF file

// echo $text; 


$text = "This is some text

with extra empty lines.\n\n\n\nLet's remove them.";
$text = preg_replace("/\n{2,}/", "\n", $text);
echo $text;



?>