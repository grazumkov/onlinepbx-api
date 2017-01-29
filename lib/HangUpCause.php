<?php
namespace xtratio\Onpbx;
/*
* Список причин завершения звонков
*/
class HangUpCause {
    
    /*Константы*/
    const UNALLOCATED_NUMBER = "UNALLOCATED_NUMBER";
    const NO_ROUTE_TRANSIT_NET = "NO_ROUTE_TRANSIT_NET";
    const NO_ROUTE_DESTINATION = "NO_ROUTE_DESTINATION";
    const CHANNEL_UNACCEPTABLE = "CHANNEL_UNACCEPTABLE";
    const CALL_AWARDED_DELIVERED = "CALL_AWARDED_DELIVERED";
    const NORMAL_CLEARING = "NORMAL_CLEARING";
    const USER_BUSY = "USER_BUSY";
    const NO_USER_RESPONSE = "NO_USER_RESPONSE";
    const NO_ANSWER = "NO_ANSWER";
    const SUBSCRIBER_ABSENT = "SUBSCRIBER_ABSENT";
    const CALL_REJECTED = "CALL_REJECTED";
    const NUMBER_CHANGED = "NUMBER_CHANGED";
    const REDIRECTION_TO_NEW_DESTINATION = "REDIRECTION_TO_NEW_DESTINATION";
    const EXCHANGE_ROUTING_ERROR = "EXCHANGE_ROUTING_ERROR";
    const DESTINATION_OUT_OF_ORDER = "DESTINATION_OUT_OF_ORDER";
    const INVALID_NUMBER_FORMAT = "INVALID_NUMBER_FORMAT";
    const FACILITY_REJECTED = "FACILITY_REJECTED";
    const RESPONSE_TO_STATUS_ENQUIRY = "RESPONSE_TO_STATUS_ENQUIRY";
    const NORMAL_UNSPECIFIED = "NORMAL_UNSPECIFIED";
    const NORMAL_CIRCUIT_CONGESTION = "NORMAL_CIRCUIT_CONGESTION";
    const NETWORK_OUT_OF_ORDER = "NETWORK_OUT_OF_ORDER";
    const NORMAL_TEMPORARY_FAILURE = "NORMAL_TEMPORARY_FAILURE";
    const SWITCH_CONGESTION = "SWITCH_CONGESTION";
    const ACCESS_INFO_DISCARDED = "ACCESS_INFO_DISCARDED";
    const REQUESTED_CHAN_UNAVAIL = "REQUESTED_CHAN_UNAVAIL";
    const PRE_EMPTED = "PRE_EMPTED";
    const FACILITY_NOT_SUBSCRIBED = "FACILITY_NOT_SUBSCRIBED";
    const OUTGOING_CALL_BARRED = "OUTGOING_CALL_BARRED";
    const INCOMING_CALL_BARRED = "INCOMING_CALL_BARRED";
    const BEARERCAPABILITY_NOTAUTH = "BEARERCAPABILITY_NOTAUTH";
    const BEARERCAPABILITY_NOTAVAIL = "BEARERCAPABILITY_NOTAVAIL";
    const SERVICE_UNAVAILABLE = "SERVICE_UNAVAILABLE";
    const BEARERCAPABILITY_NOTIMPL = "BEARERCAPABILITY_NOTIMPL";
    const CHAN_NOT_IMPLEMENTED = "CHAN_NOT_IMPLEMENTED";
    const FACILITY_NOT_IMPLEMENTED = "FACILITY_NOT_IMPLEMENTED";
    const SERVICE_NOT_IMPLEMENTED = "SERVICE_NOT_IMPLEMENTED";
    const INVALID_CALL_REFERENCE = "INVALID_CALL_REFERENCE";
    const INCOMPATIBLE_DESTINATION = "INCOMPATIBLE_DESTINATION";
    const INVALID_MSG_UNSPECIFIED = "INVALID_MSG_UNSPECIFIED";
    const MANDATORY_IE_MISSING = "MANDATORY_IE_MISSING";
    const MESSAGE_TYPE_NONEXIST = "MESSAGE_TYPE_NONEXIST";
    const WRONG_MESSAGE = "WRONG_MESSAGE";
    const IE_NONEXIST = "IE_NONEXIST";
    const INVALID_IE_CONTENTS = "INVALID_IE_CONTENTS";
    const WRONG_CALL_STATE = "WRONG_CALL_STATE";
    const RECOVERY_ON_TIMER_EXPIRE = "RECOVERY_ON_TIMER_EXPIRE";
    const MANDATORY_IE_LENGTH_ERROR = "MANDATORY_IE_LENGTH_ERROR";
    const PROTOCOL_ERROR = "PROTOCOL_ERROR";
    const INTERWORKING = "INTERWORKING";
    const ORIGINATOR_CANCEL = "ORIGINATOR_CANCEL";
    const CRASH = "CRASH";
    const SYSTEM_SHUTDOWN = "SYSTEM_SHUTDOWN";
    const LOSE_RACE = "LOSE_RACE";
    const MANAGER_REQUEST = "MANAGER_REQUEST";
    const BLIND_TRANSFER = "BLIND_TRANSFER";
    const ATTENDED_TRANSFER = "ATTENDED_TRANSFER";
    const ALLOTTED_TIMEOUT = "ALLOTTED_TIMEOUT";
    const USER_CHALLENGE = "USER_CHALLENGE";
    const MEDIA_TIMEOUT = "MEDIA_TIMEOUT";
    const PICKED_OFF = "PICKED_OFF";
    const USER_NOT_REGISTERED = "USER_NOT_REGISTERED";
    const PROGRESS_TIMEOUT = "PROGRESS_TIMEOUT";
    
     /**
    * Получить описание причины завершения звонка по ее коду
    * @param string     $cause
    */
    public static function getHangUpCauseText($cause){
        switch ($cause) {
            case HangUpCause::UNSPECIFIED:
                return 'Неизвестная ошибка';
                break;
            case HangUpCause::UNALLOCATED_NUMBER:
                return 'Несуществующий номер';
                break;
            case HangUpCause::NO_ROUTE_TRANSIT_NET:
                return 'Нет транзитного маршрута';
                break;
            case HangUpCause::NO_ROUTE_DESTINATION:
                return 'Нет заданного маршрута';
                break;
            case HangUpCause::CHANNEL_UNACCEPTABLE:
                return 'Отказ не принят';
                break;
            case HangUpCause::CALL_AWARDED_DELIVERED:
                return '';
                break;
            case HangUpCause::NORMAL_CLEARING:
                return '';
                break;
            case HangUpCause::USER_BUSY:
                return 'Абонент занят';
                break;
            case HangUpCause::NO_USER_RESPONSE:
                return 'Абонент не ответил';
                break;
            case HangUpCause::NO_ANSWER:
                return 'Нет ответа';
                break;
            case HangUpCause::SUBSCRIBER_ABSENT:
                return 'Абонент не в сети';
                break;
            case HangUpCause::CALL_REJECTED:
                return 'Вызов отклонен';
                break;
            case HangUpCause::NUMBER_CHANGED:
                return 'Номер изменился';
                break;
            case HangUpCause::REDIRECTION_TO_NEW_DESTINATION:
                return 'Вызов переадресован';
                break;
            case HangUpCause::EXCHANGE_ROUTING_ERROR:
                return 'Ошибка оператора';
                break;
            case HangUpCause::DESTINATION_OUT_OF_ORDER:
                return 'Нет заданного маршрута';
                break;
            case HangUpCause::INVALID_NUMBER_FORMAT:
                return 'Ошибка в номере';
                break;
            case HangUpCause::FACILITY_REJECTED:
                return 'Услуга недоступна';
                break;
            case HangUpCause::RESPONSE_TO_STATUS_ENQUIRY:
                return $cause;
                break;
            case HangUpCause::NORMAL_UNSPECIFIED:
                return 'Нет канала связи';
                break;
            case HangUpCause::NORMAL_CIRCUIT_CONGESTION:
                return 'Нет канала связи';
                break;
            case HangUpCause::NETWORK_OUT_OF_ORDER:
                return 'Сеть недоступна';
                break;
            case HangUpCause::NORMAL_TEMPORARY_FAILURE:
                return 'Временная ошибка';
                break;
            case HangUpCause::SWITCH_CONGESTION:
                return 'Компьютерная сеть перегружена';
                break;
            case HangUpCause::ACCESS_INFO_DISCARDED:
                return 'Отказ в обслуживании';
                break;
            case HangUpCause::REQUESTED_CHAN_UNAVAIL:
                return 'Канал связи недоступен';
                break;
            case HangUpCause::PRE_EMPTED:
                return $cause;
                break;
            case HangUpCause::FACILITY_NOT_SUBSCRIBED:
                return 'Нет доступа к услуги';
                break;
            case HangUpCause::OUTGOING_CALL_BARRED:
                return 'Исходящий вызов запрещен';
                break;
            case HangUpCause::INCOMING_CALL_BARRED:
                return 'Входящий вызов запрещен';
                break;
            case HangUpCause::BEARERCAPABILITY_NOTAUTH:
                return $cause;
                break;
            case HangUpCause::BEARERCAPABILITY_NOTAVAIL:
                return $cause;
                break;
            case HangUpCause::SERVICE_UNAVAILABLE:
                return 'Сервис недоступен';
                break;
            case HangUpCause::BEARERCAPABILITY_NOTIMPL:
                return 'Плохое интернет соединение';
                break;
            case HangUpCause::CHAN_NOT_IMPLEMENTED:
                return 'Данный тип связи не поддерживается';
                break;
            case HangUpCause::FACILITY_NOT_IMPLEMENTED:
                return 'Данная услуга не поддерживается';
                break;
            case HangUpCause::SERVICE_NOT_IMPLEMENTED:
                return 'Сервис не реализован';
                break;
            case HangUpCause::INVALID_CALL_REFERENCE:
                return 'Ошибка в ссылке звонка';
                break;
            case HangUpCause::INCOMPATIBLE_DESTINATION:
                return 'Несовместимое назначение';
                break;
            case HangUpCause::INVALID_MSG_UNSPECIFIED:
                return 'Ошибка сообщения';
                break;
            case HangUpCause::MANDATORY_IE_MISSING:
                return 'Устройство не соответствует стандартам';
                break;
            case HangUpCause::MESSAGE_TYPE_NONEXIST:
                return 'Тип сообщения отсутствует';
                break;
            case HangUpCause::WRONG_MESSAGE:
                return 'Неверное сообщение';
                break;
            case HangUpCause::IE_NONEXIST:
                return 'Устройство не соответствует стандартам';
                break;
            case HangUpCause::INVALID_IE_CONTENTS:
                return 'Устройство не соответствует стандартам';
                break;
            case HangUpCause::WRONG_CALL_STATE:
                return 'Устройство не соответствует стандартам';
                break;
            case HangUpCause::RECOVERY_ON_TIMER_EXPIRE:
                return 'Время истекло';
                break;
            case HangUpCause::MANDATORY_IE_LENGTH_ERROR:
                return 'Устройство не соответствует стандартам';
                break;
            case HangUpCause::PROTOCOL_ERROR:
                return 'Устройство не соответствует стандартам';
                break;
            case HangUpCause::INTERWORKING:
                return 'Неустойчивое взаимодействие';
                break;
            case HangUpCause::ORIGINATOR_CANCEL:
                return 'Вызов отменен';
                break;
            case HangUpCause::CRASH:
                return 'Случилось страшное';
                break;
            case HangUpCause::SYSTEM_SHUTDOWN:
                return 'Потерпите минуту сервер перезагружается';
                break;
            case HangUpCause::LOSE_RACE:
                return 'Обрыв линии связи';
                break;
            case HangUpCause::MANAGER_REQUEST:
                return 'Завершен через API';
                break;
            case HangUpCause::BLIND_TRANSFER:
                return 'Без условный перевод';
                break;
            case HangUpCause::ATTENDED_TRANSFER:
                return 'Условный перевод';
                break;
            case HangUpCause::ALLOTTED_TIMEOUT:
                return 'Выделенный таймаут';
                break;
            case HangUpCause::USER_CHALLENGE:
                return 'У абонента проблемы';
                break;
            case HangUpCause::MEDIA_TIMEOUT:
                return 'Кончилась музыка';
                break;
            case HangUpCause::PICKED_OFF:
                return 'Перехвачен';
                break;
            case HangUpCause::USER_NOT_REGISTERED:
                return 'Абонент не зарегистрирован';
                break;
            case HangUpCause::PROGRESS_TIMEOUT:
                return 'Время ожидания вышло';
                break;
            default:
                return $cause;
                break;
        }
    }
}

?>