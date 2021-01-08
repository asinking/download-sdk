# 下载中心,遵循PSR-4协议）
 ### 1.实现API服务类
 ```javascript 
 /**
  * 下载中心SDK对接
  * Class TestReportService
  * @package App\Service
  */
 class TestReportService extends AbstractReport
 {
     /**
      * 访问域名
      * @var string
      */
     public $domain = "http://172.18.1.30:9507";
     /**
      * 应用环境appid
      * @var string
      */
     public $appId = '6E007E3mB=';
     /**
      * 签名秘钥串
      * @var string
      */
     public $appSecret = '676af546fe80e75b399b00aff8a018a6';
 
 }
  ```
 ### 2.创建报表
 ```javascript 
     public function createReport()
     {
         $param = [
             'env_mark' => 'local', 'zid' => 1, 'uid' => 1,
             'report_name' => '测试名称',
             'sql_condition' => '{"name":"where"}', 'page_size' => 300,
             'is_consume_time' => 0, 'data_count' => 113195,
             'callback_url' => 'http://192.168.249.130:9507/test/getDbData'
         ];
         $data = $this->_testReportService->createReport($param);#调用对应方法即可
         return $this->success($data);
     }
```
   
 ### 3.创建定时报表任务
```javascript 
   public function createTimerReport()
            {
                $param = [
                    'env_mark' => 'local', 'zid' => 1, 'uid' => 1,
                    'condition_ids' => '1;3',
                    'exec_times' => '1610019343,0,0;1610019343,0,1610019348',
                    'callback_urls' => 'http://192.168.249.130:9507/test/getDbData;http://192.168.249.130:9507/test/getDbData',
                    'taskinfo_callback_urls' => 'http://192.168.249.130:9507/test/getTimerCall;http://192.168.249.130:9507/test/getTimerCall'
                ];
                $data = $this->_testReportService->createTimerReport($param);
                return $this->success($data);
            }
```
### 4.编辑定时报表任务
```javascript 
 public function editTimerReport()
           {
               $param = [
                   'env_mark' => 'local', 'zid' => 1, 'uid' => 1,
                   #[需要删除项]
                   'del_report_ids' => '4;5;6;7',
                   #[更新项]
                   'up_report_ids' => '12;13',
                   'up_condition_ids' => '5;5',
                   'up_exec_times' => '0,0,1610019320;0,0,1610019321',
                   #[新增项]
                   'add_condition_ids' => '6',
                   'add_exec_times' => '0,1610019320,0',
                   'add_callback_urls' => 'http://192.168.249.130:9507/test/getDbData;http://192.168.249.130:9507/test/getDbData',
                   'add_taskinfo_callback_urls' => 'http://192.168.249.130:9507/test/getTimerCall;http://192.168.249.130:9507/test/getTimerCall'
               ];
               $data = $this->_testReportService->editTimerReport($param);
               return $this->success($data);
           }
```

