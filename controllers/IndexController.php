<?php


class IndexController extends BaseController
{
    public static function loadData($param)
    {
        $table = self::DB();
        if (!$table) {
            self::request($param);
        } else {
            $database = new Database();
            $database->dropData();
            self::request($param);
        }


        //f830a9aef59b452395d4977da55390b0 is api key
    }

    public function request($param)
    {
        $curl = curl_init('https://newsapi.org/v2/everything?q='.$param);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'User-Agent: Testing Application',
            'x-api-key: f830a9aef59b452395d4977da55390b0',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        $results = (json_decode($response, true));
        $articles = ($results['articles']);

        self::insertData($articles);

        curl_close($curl);
    }

    public function insertData($data)
    {
        foreach ($data as $value) {
            $post = new Post();
            $post->set($value['title'], $value['author'], $value['url']);
            $post->save();
        }
    }

    public function DB()
    {
        try {
            $database = new Database();
            return $database->checkTable();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getTableData()
    {
        $db = new Database();
        $db->prepare('SELECT * FROM posts;');
        return $db->fetch();
    }

    public static function searchData()
    {
        $param = $_REQUEST['query'];
        self::loadData($param);
    }
}
