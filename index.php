<?php

include "vendor/autoload.php";


use Vbpupil\Review\Review;
use Vbpupil\Review\ReviewCalculator;
use Vbpupil\Review\ReviewCollection;


$c = new ReviewCollection();
$c->addItem(new Review('dean', 'love this product', 'well what can i say its awesome', 4), 'dean')
    ->addItem(new Review('tanya', 'its okay', 'well it was all right', 2), 'tanya')
    ->addItem(new Review('abi', 'its okay, i suppose', 'meh', 1), 'abi')
    ->addItem(new Review('izzy', 'its okay, i suppose', 'meh *2', 3), 'izzy')
    ->addItem(new Review('amelia', 'nice', 'nice one would buy again', 5), 'amelia');

$jack = new Review('jack', 'hell raiser', 'im a hell raiser', 5);
//$jack->setMaxRating(10);
//$jack->setMinRating(3);

$c->addItem($jack, 'jack');

var_dump($c);

$rc = new ReviewCalculator();
var_dump($rc->calculate($c));