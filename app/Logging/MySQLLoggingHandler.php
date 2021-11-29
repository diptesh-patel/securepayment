<?php
namespace App\Logging;// use Illuminate\Log\Logger;
use DB;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use App\Models\EventLog;
class MySQLLoggingHandler extends AbstractProcessingHandler{
    /**
     *
     * MySQLLoggingHandler: store detail into DB
     *
     */
    public function __construct($level = Logger::DEBUG, $bubble = true) {
        $this->table = 'event_logs';
        parent::__construct($level, $bubble);
    }    
    protected function write(array $record):void{
        EventLog::create([
            'message' => $record['message'],
            'context' => json_encode($record['context']),
            'level' => $record['level'],
            'level_name'=>$record['level_name'],
            'channel'=>$record['channel'],
            'record_datetime'=>$record['datetime']->format('Y-m-d H:i:s'),
            'extra'=>json_encode($record['extra']),
            'formatted'=>$record['formatted'],
            'remote_addr'=>request()->ip(),
            'user_agent'=>request()->userAgent()
        ]);
       
    }
}