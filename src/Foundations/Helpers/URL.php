<?php

namespace Orbitali\Foundations;

use Orbitali\Foundations\Helpers\Relation;
use Orbitali\Http\Models\Website;

class URL
{
    const ORIGINAL = "original";
    const REDIRECT = "redirect";

    public static function create($website, $url, $model, $type = null)
    {
        $_website_id = null;
        $_url = $url;
        $_type = null;

        //Parse website attribute
        if (is_a($website, Website::class)) {
            $_website_id = $website->id;
        } elseif (is_int($website)) {
            $_website_id = $website;
        } elseif (is_string($website)) {
            $website = Website::where("domain", $website)->first();
            $_website_id = $website->id;
        } else {
            throw new \Exception(
                __CLASS__ . " : Website attribute invalid",
                __LINE__
            );
        }

        //Parse url attribute
        if (!is_string($_url)) {
            throw new \Exception(
                __CLASS__ . " : Url path invalid must be string",
                __LINE__
            );
        }

        //Parse model attribute
        if (
            $model == null ||
            !is_a($model, \Illuminate\Database\Eloquent\Model::class) ||
            !method_exists(get_class($model), "url")
        ) {
            throw new \Exception(
                __CLASS__ .
                    " : Model invalid should be extends Model inside Eloquent and has url morph ",
                __LINE__
            );
        }

        if ($type == null) {
            $_type = self::ORIGINAL;
        }

        //Check redirect table for urls
        list($_exist, $__url, $__type) = self::checkUrl($_website_id, $_url);

        if ($__type == self::REDIRECT) {
            $__url->delete();
        } elseif ($__type == self::ORIGINAL) {
            throw new \Exception(
                __CLASS__ .
                    " : Big mistake here, url must not inside in url table",
                __LINE__
            );
        }

        $_url = new \Orbitali\Http\Models\Url([
            "website_id" => $_website_id,
            "url" => $_url,
            "type" => $_type,
        ]);
        $model->url()->save($_url);
    }

    /**
     * @param Website|int|string $website
     * @param Url|RedirectUrl|int|string $url
     * @param null|Model $model
     * @param boolean $orderOfUrlTable false is URL - Redirect | true is Redirect URL
     * @return array [ isExist , urlModel, type ]
     * @throws \Exception
     */
    private static function checkUrl($website, $url, $model = null)
    {
        $_website_id = null;
        $_model_type = null;
        $_model_id = null;
        $_url = null;

        //Parse website attribute
        if (is_a($website, Website::class)) {
            $_website_id = $website->id;
        } elseif (is_int($website)) {
            $_website_id = $website;
        } elseif (is_string($website)) {
            $website = Website::where("slug", $website)->first();
            $_website_id = $website->id;
        } else {
            throw new \Exception(
                __CLASS__ . " : Website attribute invalid",
                __LINE__
            );
        }

        //parse model attribute
        if (is_a($model, \Illuminate\Database\Eloquent\Model::class)) {
            $_model_type = Relation::relationFinder($model);
            $_model_id = $model->id;
        } elseif (
            is_array($model) &&
            count($model) == 2 &&
            is_string($model[0]) &&
            is_int($model[1])
        ) {
            $_model_type = $model[0];
            $_model_id = $model[1];
        }

        //parse url attribute
        if (is_a($url, \Orbitali\Http\Models\Url::class)) {
            $_url = $url;
            $_type = $url->type;
            if ($_url->website_id != $_website_id) {
                //Nothing found
                return [false, null, null];
            }
        } elseif (is_int($url)) {
            $_where["id"] = $url;
        } elseif (is_string($url)) {
            $_where["url"] = $url;
        } else {
            throw new \Exception(
                __CLASS__ . ": URL did match any row ",
                __LINE__
            );
        }

        if ($_url == null) {
            $_where += ["website_id" => $_website_id];
            if ($_model_type != null && $_model_id != null) {
                $_where += [
                    "model_type" => $_model_type,
                    "model_id" => $_model_id,
                ];
            }

            $_url = \Orbitali\Http\Models\Url::where($_where)->first();
            $_type = $_url->type;
        }

        if ($_url) {
            return [$_url->exists, $_url, $_type];
        } else {
            return [false, null, null];
        }
    }

    /**
     * @param Website|int $website
     * @param Url|int|string $url
     * @throws \Exception
     */
    public static function delete($website, $url)
    {
        list($_exist, $_url, $_type) = self::checkUrl($website->id, $url);
        if ($_exist) {
            $_url->delete();
        }
    }

    /**
     * @param Website|int $website
     * @param Url|int|string $url
     * @param null|string $new_url
     * @param null|Model $model
     * @param null|string $type
     * @throws \Exception
     */
    public static function update(
        $website,
        $url,
        $new_url = null,
        $model = null,
        $type = null
    ) {
        /** @var Model $_url */
        $_url = null;
        $_type = null;
        $_model = null;
        $_website_id = null;

        if (is_a($website, Website::class)) {
            $_website_id = $website->id;
        } elseif (is_int($website)) {
            $_website_id = $website;
        } elseif (is_string($website)) {
            $website = Website::where("slug", $website)->first();
            $_website_id = $website->id;
        } else {
            throw new \Exception(
                __CLASS__ . " : Website attribute invalid",
                __LINE__
            );
        }

        //Find Url inside the table
        list($_exist, $_url_new, $_type_new) = self::checkUrl(
            $_website_id,
            $new_url
        );
        if ($_exist && $_type_new != self::REDIRECT) {
            throw new \Exception(__CLASS__ . " : New URL used", __LINE__);
        }

        //Find Url inside the table
        list($_exist, $_url, $_type) = self::checkUrl($_website_id, $url);
        if ($url == null) {
            return;
        }

        if ($_type == self::REDIRECT) {
            $_url->delete();
            $_type = $type != null ? $type : self::ORIGINAL;
            $_model = $model != null ? $model : $_url->model->model;
            $_url = new \Orbitali\Http\Models\Url(
                array_only($_url->getOriginal(), ["website_id", "url"]) + [
                    "type" => $_type,
                ]
            );
        } elseif ($_type == self::ORIGINAL) {
            RedirectUrl::where([
                "model_id" => $_url->id,
                "model_type" => Url::class,
            ])->delete();
        }

        if ($model != null && !is_a($model, Model::class)) {
            throw new \Exception(__CLASS__ . " : Model invalid", __LINE__);
        }

        if ($model != null && !method_exists(get_class($model), "url")) {
            throw new \Exception(
                __CLASS__ . " :  Url Morph not found in this model",
                __LINE__
            );
        }

        if ($new_url == null || !is_string($new_url)) {
            throw new \Exception(__CLASS__ . " : New url invalid", __LINE__);
        }

        //Update if necessary
        if ($new_url != null) {
            $_url->url = $new_url;
        }

        if ($_type != null) {
            $_url->type = $_type;
        }

        if ($_model != null) {
            $_url->model_type = get_class($_model);
            $_url->model_id = $_model->id;
        }

        $isDirty = $_url->exists && $_url->isDirty("url");
        $originalUrl = $_url->getOriginal("url");
        $_url->save();

        if ($isDirty) {
            (new \Orbitali\Http\Models\Url([
                "website_id" => $_url->website_id,
                "url" => $originalUrl,
                "model_type" => get_class($_url),
                "model_id" => $_url->id,
            ]))->save();
        }
    }

    /**
     * @param Website|int $website
     * @param Url|int|string $url
     * @return array it has [ isExist , urlModel, type ]
     * @throws \Exception
     */
    public static function exists($website, $url)
    {
        return self::checkUrl($website, $url);
    }

    public static function cleanURL(&$path)
    {
        return $path = trim(preg_replace("/\/{2,}/", "/", $path), "/");
    }
}
