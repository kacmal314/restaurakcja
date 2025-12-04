<?php

namespace App\Helper\Enumeration;

enum Status : string
{
  case Unfinished = 'unfinished';
  case Done = 'done';
}