<?php

namespace Kryptonit3\Counter;

use Kryptonit3\Counter\Models\Page;
use Kryptonit3\Counter\Models\Visitor;
use Rhumsaa\Uuid\Uuid;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Carbon\Carbon;

class Counter
{
    public function __construct(CrawlerDetect $visitor)
    {
        $this->visitor = $visitor;    
    }
    
    // Don't count hits from search robots and crawlers.
    public $ignore_bots = true;
    // Don't count the hit if the browser sends the DNT: 1 header.
    public $honor_do_not_track = false;
    
    public $dnt_present = (isset($_SERVER['HTTP_DNT']) && $_SERVER['HTTP_DNT'] == 1) ? true : false;

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

        if ($inore_bots && $this->visitor->isCrawler()) {
            $addHit = false;
        }
        if ($honor_do_not_track && $dnt_present) {
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
