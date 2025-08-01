<?php

namespace App\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExchangeController extends Controller
{
    //
    public function __invoke(Request $req)
    {
        if ($req->input("Protocol")) {
            if ($req->input("Protocol") === "EWS") {
                abort(404);
            }
            abort(404);
        }
        $body = $req->getContent();
        $doc = new DOMDocument();
        if ($body) {
            $doc->loadXML($body);
        }
        $response_schema = "https://schemas.microsoft.com/exchange/autodiscover/outlook/responseschema/2006a";

        $response_schemas = $doc->getElementsByTagName("AcceptableResponseSchema");
        if (0 < $response_schemas->count()) {
            $response_schema = $response_schemas->item(0)->textContent;
        }

        $email_address = "@freemail.dau.jp";
        $domain = "freemail.dau.jp";
        $user = "";
        $email_addresses = $doc->getElementsByTagName("EMailAddress");
        if (0 < $email_addresses->count()) {
            $email_address = $email_addresses->item(0)->textContent;
            $domain = substr(strrchr($email_address, "@"), 1);
            $user = substr($email_address, 0, strlen($email_address) - strlen($domain) - 1);
        }
        Log::info("configs", [config("email_autoconfig")]);
        Log::info("domain", [$domain]);
        Log::info("user", [$user]);
        if (!array_key_exists($domain, config("email_autoconfig.config"))) {
            abort(405);
        }

        $config = config("email_autoconfig.config")[$domain];

        return response(view("autodiscover", ["domain" => $domain, "email" => $email_address, "username" => $user, "config" => $config, "schema" => $response_schema])->render())->header("Content-Type", "text/xml");
    }
}
