# 下载中心
  # API使用指引
  ```javascript 
  下载中心SDK地址：composer require ak/download 
  镜像地址请修改为（公司仓库）：http://106.55.12.47:6789/
 设置为公司仓库地址：composer config -g repo.packagist composer http://106.55.12.47:6789/
 
  composer.json中加入：
   "config": {
          "secure-http": false
      }
   ```
   
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
     /**
       * 连接超时时间
       * @var int
       */
      public $connect_timeout = 10;
      /**
       * 接收缓冲数据等待时间
       * @var int
       */
      public $curlopt_timeout = 60;
  }
   ```
  ### 2.创建报表
  ```javascript 
      public function createReport()
      {
                  $param = [
                      'company_id' => 1, 'uid' => 1,
                      'report_name' => '测试报表' . mt_rand(1, 100),
                      'query_condition' => '{"k1":"v1","k2":"v2"}',
                      'chunk_num' => 189,
                      'is_consume_time' => 0,
                      'report_group_id' => 1,
                      'callback_url' => 'http://172.18.1.30:9507/test/getDbData'
                  ];
                  $data = $this->_testReportService->createReport($param);
                  return $this->success($data);
      }
 
 ```
 ```javascript
 URL请求示例:[GET]http://172.18.1.30:9507/test/getDbData?action=0&query_condition={'k1'=>'v1','k2'=>'v2'......}
 其中appid和sign通过Header头部传递:
 'Asink-Appid:6E007E3mB'
 'Asink-Sign:GHGIRTHWIGHTRIGRTGRTWHGHRTGHTRHGHRTG'
 
 字段含义：
 action=0 表示获取定时报表任务总分页数chunk_size
 action=1 表示获取获取分块数据
 query_condition:查询条件
 
 #callback_url获取参数返回示例：（action=0）
 return ParamUtil::data2compress([            #返回的数据进行压缩处理，SDK中已包含此方法
             'code' => 200,
             'msg' => 'success',
             'data' => [
                 'chunk_size'=>189           #返回chunk_size即可
             ]
         ]); 
 
 
 #callback_url获取参数返回示例：（action=1）
 
 $data = [
             'data_chunk' => [                        #分块数据集合
                ['k1'=>'v1','k2'=>'v2','k3'=>'v3'],
                ['k1'=>'v1','k2'=>'v2','k3'=>'v3'],
                ['k1'=>'v1','k2'=>'v2','k3'=>'v3']
              ],              
             'page_info' => [                         #分页相关数据信息【仅page=1传】
                  'data_count'=>113195,               #数据总条数,比传项
                  'page_size'=>600,                   #分页大小,比传项
                  'report_date_range'=>'-'            #报告日期范围,可选项，主要用在定时报表任务中，定时任务时间范围区间不确定
              ],
             'merge_cells' => ['A1:B1'],              #需要操作合并的单元格,可不传【仅page=1传】
             'headers' =>[                            #表头，必须是二维数组【仅page=1传】
                 ['合并项', '创建时间'],
                 ['序号','数据ID', '时间相关合并项'],
              ];
         ];
         return ParamUtil::data2compress([            #返回的数据进行压缩处理，SDK中已包含此方法
             'code' => 200,
             'msg' => 'success',
             'data' => $data
         ]); 
 ```
    
  ### 3.创建定时报表任务
 ```javascript 
  public function createTimerReport()
     {
         $param = [
             'company_id' => 1, 'uid' => 1,
             'report_group_id' => 2,
             'report_group_numbers' => '1;3',
             'exec_times' => '1610019343,0,0;1610019343,0,1610019348',
             'callback_urls' => 'http://8.129.179.207:9507/test/getDbData;http://8.129.179.207:9507/test/getDbData',
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
             'company_id' => 1, 'uid' => 1,
             #[需要删除项]
             'del_report_ids' => '30',
             #[更新项]
             'up_report_ids' => '31;32',
             'up_exec_times' => '0,0,1610019320;0,0,1610019321',
             #[新增项]
             'report_group_id' => 2,  #仅当有新增项时传
             'add_group_numbers' => '6',
             'add_exec_times' => '0,1610019320,0',
             'add_callback_urls' => 'http://8.129.179.207:9507/test/getDbData;http://8.129.179.207:9507/test/getDbData',
         ];
         $data = $this->_testReportService->editTimerReport($param);
         return $this->success($data);
     }
 ```
 ### 5.重试导出报表
 ```javascript 
        public function retryReportExport()
            {
                $param = [
                    'company_id' => 1, 'uid' => 1,
                    'report_id' => 84
                ];
                $data = $this->_testReportService->retryReportExport($param);
                return $this->success($data);
            }
 ```
 ### 6.获取所有分组任务
 ```javascript 
         public function getAllTaskGroup()
            {
                $data = $this->_testReportService->getConditionGroupList([]);
                return $this->success($data);
            }
 ```

