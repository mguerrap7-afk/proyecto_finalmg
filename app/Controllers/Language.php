<?php

namespace App\Controllers;

class Language extends BaseController
{
public function set(string $locale)
{
if (in_array($locale, ['en', 'es'], true)) {
session()->set('locale', $locale);
}
return redirect()->back();
}
}
