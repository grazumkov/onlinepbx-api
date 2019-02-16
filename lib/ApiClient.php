<?php
namespace xtratio\Onpbx;

use xtratio\Onpbx\Http\Client;
use xtratio\Onpbx\Response\ApiJsonResponse;

/**
 *  API client class
 */
class ApiClient
{
    protected $client;

    /**
     * Client creating
     *
     * @param  string $domain
     * @param  string $authKey
     * @param  bool $needNew
     * @return mixed
     */
    public function __construct($domain, $authKey, $needNew = false)
    {
        $this->client = new Client($domain, $authKey, $needNew);
    }
    
    private static function checkEmpty($paramName, $dataArray)
    {
        if (!sizeof($dataArray)) {
            throw new InvalidArgumentException("Parameter `{$paramName}` must contains keys");
        }
    }
    
    private static function checkRequired($reuiredKeysArray, $paramName, $dataArray)
    {
        foreach ($reuiredKeysArray as $key) {
            if (!array_key_exists($key,$dataArray)) {
                throw new InvalidArgumentException("`{$paramName}` must contains required parameter `{$key}`");
            }
        }      
    }

    /**
     * Создать мгновенный звонок
     *
     * @param  array       $data
     * @return ApiJsonResponse
     */
    public function callNow(array $data)
    {
        /*
            data example:
            from : "2222222",          // [обязательный] Кто, первый вызываемый номер (любой)
            to : "7777777777",         // [обязательный] Кому, второй вызываемый номер (любой)
            gate_from: "73432048020",  // Номер транка для первого номера
            gate_to : "3509907",       // Номер транка для второго номера
            to_domain : "example.onpbx.ru",   // Указываете домен на который должен быть совершен звонок (для прямых звонков)
            from_orig_number : "77777777777", // Телефонный номер который увидит первый вызываемый номер
            from_orig_name : "Best inc."      // Имя пользователя которое увидит первый вызываемый номер
        */
        self::checkEmpty("data", $data);
        self::checkRequired(array("from", "to"), "data", $data);
        
        return $this->client->sendRequest("call/now.json", $data);
    }

    /**
     * Создать отложенный звонок
     *
     * @param  array       $data
     * @return ApiJsonResponse
     */
    public function callLeter(array $data)
    {
        /*
        data example:
        from : "2222222",          // [обязательный] Кто, первый вызываемый номер (любой)
        to : "7777777777",         // [обязательный] Кому, второй вызываемый номер (любой)
        gate_from: "73432048020",  // Номер транка для первого номера
        gate_to : "3509907",       // Номер транка для второго номера
        to_domain : "example.ru",  // Указываете домен на который должен быть совершен звонок (для прямых звонков)
        date : "1 Dec 2013 16:50:58 GMT" // Дата в формате (RFC-2822)
        */
        self::checkEmpty("data", $data);
        self::checkRequired(array("from", "to"), "data", $data);
        
        return $this->client->sendRequest("call/leter.json", $data);
    }
    
     /**
     * История звонков
     *
     * @param  array       $data
     * @return ApiJsonResponse
     */
    public function callHistory(array $data)
    {
        /*
        data example:
        duration_from : "100",                 // Длительность (всего звонка) от (сек.)
        duration_to : "300",                   // Длительность (всего звонка) до (сек.)
        billsec_from : "100",                  // Продолжительность разговора от (сек.)
        billsec_to : "300",                    // Продолжительность разговора до (сек.)
        date_from : "1 Apr 2013 00:00:01 GMT", // Дата от (RFC-2822)
        date_to : "1 Apr 2013 23:59:59 GMT",   // Дата до (RFC-2822)
        number : "222",                        // По точному номеру
        out_number : "203",                    // По части номера (выдается любой номер содержащий в себе эти цифры).
        type : "inbound"                     // По типу - inbound/outbound/local
        uuid : "73181a6f-17d6-4c91-9222-e871760e544f", // Выдача конкретного звонка по уникальному ID
        uuid_array : ["73181a6f-17d6-4c91-9222-e871760e544f", "ea734b25-a6f5-4557-91b8-7b26088bc748"], // Выдача нескольких звонков по списку ID
        download : true   // Если параметр указан то вместо массива данных будет
                       // возвращен URL для скачивания файла записей звонков.
                       // Если найден 1 звонок, то время жизни ссылки 200 секунд, иначе 1 час.
        */
        self::checkEmpty("data", $data);
        self::checkRequired(array("date_from", "date_to"), "data", $data);
        
        return $this->client->sendRequest("history/search.json", $data);
    }
    
     /**
     * Поиск контакта
     *
     * @param  array       $data
     * @return ApiJsonResponse
     */
    public function icmSearch(array $data)
    {
        /*
        data example:
            out_num : "3432048020",    // Внешний номер
            int_num : "222",           // Внутренний номер сотрудника
            date_from : "1 Apr 2013 00:00:01 GMT",          // Дата последнего изменения от (RFC-2822)
            date_to : "1 Apr 2013 23:59:59 GMT",            // Дата последнего изменения до (RFC-2822)
            creation_date_from : "1 Apr 2013 00:00:01 GMT", // Дата создания от (RFC-2822)
            creation_date_to : "1 Apr 2013 23:59:59 GMT",   // Дата создания до (RFC-2822)
        */
        self::checkEmpty("data", $data);
        
        return $this->client->sendRequest("icm/search.json", $data);
    }
    
     /**
     * Добавить Контакт
     *
     * @param  array       $data
     * @return ApiJsonResponse
     */
    public function icmAdd(array $data)
    {
        /*
        data example:
            out_num : "4955055757", // [обязательно] Внешний номер
            out_name : "Pronto",    // Имя контакта
            int_num : "222",        // [обязательно] Внутренний номер сотрудника
            block : "1",            // Защита от изменений 1/0 (включена/выключена)
            note : "Pizza"          // Примечание
        */
        self::checkEmpty("data", $data);
        self::checkRequired(array("int_num", "out_num"), "data", $data);
        
        return $this->client->sendRequest("icm/add.json", $data);
    }
    
     /**
     * Изменить контакт
     *
     * @param  array       $data
     * @return ApiJsonResponse
     */
    public function icmEdit(array $data)
    {
        /*
        data example:
             out_num : "4955055757", // [обязательно] Внешний номер
            out_name : "Pronto",    // Имя контакта
            int_num : "222",        // [обязательно] Внутренний номер сотрудника
            block : "1",            // Защита от изменений 1/0 (включена/выключена)
            note : "Pizza"          // Примечание
        */
        self::checkEmpty("data", $data);
        self::checkRequired(array("int_num", "out_num"), "data", $data);
        
        return $this->client->sendRequest("icm/edit.json", $data);
    }
    
     /**
     * Добавить пользователя
     *
     * @param  array       $data
     * @return ApiJsonResponse
     */
    public function userAdd(array $data)
    {
        /*
        data example:
            num : "222",            // [обязательно] Внутренний номер пользователя
            pass : "2vbub293jidm2", // [обязательно] Пароль
            name : "Vyacheslav",    // Имя (латинскими буквами)
            delay1 : "30",          // Задержка 1
            tr1 :    "223",         // Номер при недоступности 1
            delay2 : "30",          // Задержка 2
            tr2 :    "224",         // Номер при недоступности 2
            delay3 : "30",          // Задержка 3
            tr3 :    "3432048020"   // Номер при недоступности 3
        */
        self::checkEmpty("data", $data);
        self::checkRequired(array("num", "pass"), "data", $data);
        
        return $this->client->sendRequest("user/add.json", $data);
    }
    
     /**
     * Изменить пользователя
     *
     * @param  array       $data
     * @return ApiJsonResponse
     */
    public function userEdit(array $data)
    {
        /*
        data example:
            num : "222",            // [обязательно] Внутренний номер пользователя
            pass : "2vbub293jidm2", // [обязательно] Пароль
            name : "Vyacheslav",    // Имя (латинскими буквами)
            delay1 : "30",          // Задержка 1
            tr1 :    "223",         // Номер при недоступности 1
            delay2 : "30",          // Задержка 2
            tr2 :    "224",         // Номер при недоступности 2
            delay3 : "30",          // Задержка 3
            tr3 :    "3432048020"   // Номер при недоступности 3
        */
        self::checkEmpty("data", $data);
        self::checkRequired(array("num", "pass"), "data", $data);
        
        return $this->client->sendRequest("user/edit.json", $data);
    }
    
     /**
     * Получить пользователя по внутреннему номеру
     *
     * @param  int       $num
     * @return ApiJsonResponse
     */
    public function userGet($num)
    {
        /*
            num : "222",            // [обязательно] Внутренний номер пользователя
        */
        if (!isset($num)) {
            throw new InvalidArgumentException('Num not set');
        }
        
        return $this->client->sendRequest("user/get.json", ['num' => $num]);
    }
    
      /**
     * Получить список номеров пользователей
     *
     * @return ApiJsonResponse
     */
    public function userList()
    {
        return $this->client->sendRequest("user/get.json", array());
    }
}
