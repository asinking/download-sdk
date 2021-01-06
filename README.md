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
        $data = $this->_testReportService->createReport($param);
        return $this->success($data);
    }
  ```
