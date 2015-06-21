<?php

namespace Kryptonit3\Counter;

use Kryptonit3\Counter\Models\Page;
use Kryptonit3\Counter\Models\Visitor;
use Rhumsaa\Uuid\Uuid;
use Carbon\Carbon;

class Counter
{
    // Don't count hits from search robots and crawlers.
    const IGNORE_SEARCH_BOTS = true;
    // Don't count the hit if the browser sends the DNT: 1 header.
    const HONOR_DO_NOT_TRACK = false;

    public function show($identifier, $id = null)
    {
        $page = self::pageId($identifier, $id);
        
        $hits = self::countHits($page);

        return $hits;
    }

    public function showAndCount($identifier, $id = null)
    {
        $page = self::pageId($identifier, $id);

        $addHit = true;

        if (self::IGNORE_SEARCH_BOTS && self::IsSearchBot()) {
            $addHit = false;
        }
        if (self::HONOR_DO_NOT_TRACK &&
            isset($_SERVER['HTTP_DNT']) && $_SERVER['HTTP_DNT'] == "1") {
            $addHit = false;
        }
        if ($addHit) {
            self::createCountIfNotPresent($page);
        }
        $hits = self::countHits($page);

        return $hits;
    }

    /*
     * Return hit count for every page on the site.
     * You may specify a day constraint.
     * Example Last 30 Days: Counter::allHits(30);
     */
    public function allHits($days = null)
    {
        $visitors = Visitor::all();
        if ($days) {
            $visitors = Visitor::where('created_at', '>=', Carbon::now()->subDays($days));
        }
        return number_format($visitors->count());
    }


    /*====================== PRIVATE METHODS =============================*/

    private static function IsSearchBot()
    {
        // Of course, this is not perfect, but it at least catches the major
        // search engines that index most often.
        $keywords = [
            'bot',
            'spider',
            'spyder',
            'crawlwer',
            'walker',
            'search',
            'yahoo',
            'holmes',
            'htdig',
            'archive',
            'tineye',
            'yacy',
            'yeti',
        ];
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

        return (in_array($agent, $keywords)) ? true : false;
    }

    private static function hashVisitor($page)
    {
        $visitor = $_SERVER['REMOTE_ADDR'];
        return hash("SHA256", $page . $visitor);
    }

    public static function pageId($identifier, $id = null)
    {
        $uuid5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, $identifier);
        if ($id) {
            $uuid5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, $identifier . '-' . $id);
        }

        return $uuid5;
    }
    
    public static function createVisitorRecordIfNotPresent($visitor)
    {
        $visitor_record = Visitor::firstOrCreate([
            'visitor' => $visitor
        ]);
        
        return $visitor_record;
    }
    
    public static function createPageIfNotPresent($page)
    {
        $page_record = Page::firstOrCreate([
            'page' => $page
        ]);
        
        return $page_record;
    }

    public static function createCountIfNotPresent($page)
    {
        $page_record = self::createPageIfNotPresent($page);

        $visitor = self::hashVisitor($page);
        
        $visitor_record = self::createVisitorRecordIfNotPresent($visitor);

        $page_record->visitors()->sync([$visitor_record->id]);
    }

    public static function countHits($page)
    {
        $page_record = self::createPageIfNotPresent($page);

        return number_format($page_record->visitors->count());
    }
}
