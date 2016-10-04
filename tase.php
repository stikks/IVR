<?php

$value = '{
  ["body"]=>
  string(527) "{"msisdn":"08170814752","billingTransactionID":"ISLAM7109","serviceShortCode":"53011","serviceId":"2131","serviceName":"ISLAMZN20","billingDescription":"MT_billing","billingEventType":"platform_renew","servicePrice":"2000","serviceKeyword":"MT","servicePeriod":"1","callback_url":"http:\/\/localhost:8585\/sevas\/EtisalatDirectBillingResponseCallBack?serviceID=1291&subscriber=08170814752&billingCode=55010&billingSrcModule=SubscriptionRenewal&transactionID=ISLAM7109&amount=2000&content=No Content&transactionResponseCode=%d"}"
  ["body_size"]=>
  int(527)
  ["is_truncated"]=>
  bool(false)
  ["content_encoding"]=>
  NULL
  ["delivery_info"]=>
  array(6) {
    ["channel"]=>
    object(PhpAmqpLib\Channel\AMQPChannel)#15 (28) {
      ["callbacks"]=>
      array(1) {
        ["amq.ctag-6srDIV9Tbg1G-wVycyPgzQ"]=>
        object(Closure)#4 (1) {
          ["parameter"]=>
          array(1) {
            ["$workload"]=>
            string(10) "<required>"
          }
        }
      }
      ["is_open":protected]=>
      bool(true)
      ["default_ticket":protected]=>
      int(0)
      ["active":protected]=>
      bool(true)
      ["alerts":protected]=>
      array(0) {
      }
      ["auto_decode":protected]=>
      bool(true)
      ["basic_return_callback":protected]=>
      NULL
      ["batch_messages":protected]=>
      array(0) {
      }
      ["published_messages":"PhpAmqpLib\Channel\AMQPChannel":private]=>
      array(0) {
      }
      ["next_delivery_tag":"PhpAmqpLib\Channel\AMQPChannel":private]=>
      int(0)
      ["ack_handler":"PhpAmqpLib\Channel\AMQPChannel":private]=>
      NULL
      ["nack_handler":"PhpAmqpLib\Channel\AMQPChannel":private]=>
      NULL
      ["publish_cache":"PhpAmqpLib\Channel\AMQPChannel":private]=>
      array(0) {
      }
      ["publish_cache_max_size":"PhpAmqpLib\Channel\AMQPChannel":private]=>
      int(100)
      ["frame_queue":protected]=>
      array(0) {
      }
      ["method_queue":protected]=>
      array(0) {
      }
      ["amqp_protocol_header":protected]=>
"
      ["debug":protected]=>
      object(PhpAmqpLib\Helper\DebugHelper)#19 (2) {
        ["debug":protected]=>
        bool(false)
        ["PROTOCOL_CONSTANTS_CLASS":protected]=>
        string(28) "PhpAmqpLib\Wire\Constants091"
      }
      ["connection":protected]=>
      object(PhpAmqpLib\Connection\AMQPStreamConnection)#3 (42) {
        ["channels"]=>
        array(2) {
          [0]=>
          *RECURSION*
          [1]=>
          *RECURSION*
        }
        ["version_major":protected]=>
        int(0)
        ["version_minor":protected]=>
        int(9)
        ["server_properties":protected]=>
        array(7) {
          ["capabilities"]=>
          array(2) {
            [0]=>
            string(1) "F"
            [1]=>
            array(9) {
              ["publisher_confirms"]=>
              array(2) {
                [0]=>
                string(1) "t"
                [1]=>
                int(1)
              }
              ["exchange_exchange_bindings"]=>
              array(2) {
                [0]=>
                string(1) "t"
                [1]=>
                int(1)
              }
              ["basic.nack"]=>
              array(2) {
                [0]=>
                string(1) "t"
                [1]=>
                int(1)
              }
              ["consumer_cancel_notify"]=>
              array(2) {
                [0]=>
                string(1) "t"
                [1]=>
                int(1)
              }
              ["connection.blocked"]=>
              array(2) {
                [0]=>
                string(1) "t"
                [1]=>
                int(1)
              }
              ["consumer_priorities"]=>
              array(2) {
                [0]=>
                string(1) "t"
                [1]=>
                int(1)
              }
              ["authentication_failure_close"]=>
              array(2) {
                [0]=>
                string(1) "t"
                [1]=>
                int(1)
              }
              ["per_consumer_qos"]=>
              array(2) {
                [0]=>
                string(1) "t"
                [1]=>
                int(1)
              }
              ["direct_reply_to"]=>
              array(2) {
                [0]=>
                string(1) "t"
                [1]=>
                int(1)
              }
            }
          }
          ["cluster_name"]=>
          array(2) {
            [0]=>
            string(1) "S"
            [1]=>
            string(18) "rabbit@workstation"
          }
          ["copyright"]=>
          array(2) {
            [0]=>
            string(1) "S"
            [1]=>
            string(46) "Copyright (C) 2007-2016 Pivotal Software, Inc."
          }
          ["information"]=>
          array(2) {
            [0]=>
            string(1) "S"
            [1]=>
            string(53) "Licensed under the MPL.  See http://www.rabbitmq.com/"
          }
          ["platform"]=>
          array(2) {
            [0]=>
            string(1) "S"
            [1]=>
            string(10) "Erlang/OTP"
          }
          ["product"]=>
          array(2) {
            [0]=>
            string(1) "S"
            [1]=>
            string(8) "RabbitMQ"
          }
          ["version"]=>
          array(2) {
            [0]=>
            string(1) "S"
            [1]=>
            string(5) "3.6.5"
          }
        }
        ["mechanisms":protected]=>
        array(2) {
          [0]=>
          string(8) "AMQPLAIN"
          [1]=>
          string(5) "PLAIN"
        }
        ["locales":protected]=>
        array(1) {
          [0]=>
          string(5) "en_US"
        }
        ["wait_tune_ok":protected]=>
        bool(false)
        ["known_hosts":protected]=>
        string(0) ""
        ["input":protected]=>
        object(PhpAmqpLib\Wire\AMQPReader)#14 (9) {
          ["str":protected]=>
          NULL
          ["str_length":protected]=>
          int(0)
          ["offset":protected]=>
          int(1217)
          ["bitcount":protected]=>
          int(0)
          ["is64bits":protected]=>
          bool(true)
          ["timeout":protected]=>
          int(0)
          ["bits":protected]=>
          int(0)
          ["io":protected]=>
          object(PhpAmqpLib\Wire\IO\StreamIO)#5 (14) {
            ["protocol":protected]=>
            string(3) "tcp"
            ["host":protected]=>
            string(9) "127.0.0.1"
            ["port":protected]=>
            string(4) "5672"
            ["connection_timeout":protected]=>
            float(3)
            ["read_write_timeout":protected]=>
            float(3)
            ["context":protected]=>
            resource(19) of type (stream-context)
            ["keepalive":protected]=>
            bool(false)
            ["heartbeat":protected]=>
            int(0)
            ["last_read":protected]=>
            float(1475238371.0193)
            ["last_write":protected]=>
            float(1475238366.2849)
            ["last_error":protected]=>
            NULL
            ["sock":"PhpAmqpLib\Wire\IO\StreamIO":private]=>
            resource(24) of type (stream)
            ["canSelectNull":"PhpAmqpLib\Wire\IO\StreamIO":private]=>
            bool(true)
            ["canDispatchPcntlSignal":"PhpAmqpLib\Wire\IO\StreamIO":private]=>
            bool(true)
          }
          ["isLittleEndian":protected]=>
          bool(true)
        }
        ["vhost":protected]=>
        string(1) "/"
        ["insist":protected]=>
        bool(false)
        ["login_method":protected]=>
        string(8) "AMQPLAIN"
        ["login_response":protected]=>
        string(35) "LOGINSguesPASSWORDSguest"
        ["locale":protected]=>
        string(5) "en_US"
        ["heartbeat":protected]=>
        int(0)
        ["sock":protected]=>
        NULL
        ["channel_max":protected]=>
        int(65535)
        ["frame_max":protected]=>
        int(131072)
        ["construct_params":protected]=>
        array(4) {
          [0]=>
          string(9) "127.0.0.1"
          [1]=>
          string(4) "5672"
          [2]=>
          string(5) "guest"
          [3]=>
          string(5) "guest"
        }
        ["close_on_destruct":protected]=>
        bool(true)
        ["is_connected":protected]=>
        bool(true)
        ["io":protected]=>
        object(PhpAmqpLib\Wire\IO\StreamIO)#5 (14) {
          ["protocol":protected]=>
          string(3) "tcp"
          ["host":protected]=>
          string(9) "127.0.0.1"
          ["port":protected]=>
          string(4) "5672"
          ["connection_timeout":protected]=>
          float(3)
          ["read_write_timeout":protected]=>
          float(3)
          ["context":protected]=>
          resource(19) of type (stream-context)
          ["keepalive":protected]=>
          bool(false)
          ["heartbeat":protected]=>
          int(0)
          ["last_read":protected]=>
          float(1475238371.0193)
          ["last_write":protected]=>
          float(1475238366.2849)
          ["last_error":protected]=>
          NULL
          ["sock":"PhpAmqpLib\Wire\IO\StreamIO":private]=>
          resource(24) of type (stream)
          ["canSelectNull":"PhpAmqpLib\Wire\IO\StreamIO":private]=>
          bool(true)
          ["canDispatchPcntlSignal":"PhpAmqpLib\Wire\IO\StreamIO":private]=>
          bool(true)
        }
        ["wait_frame_reader":protected]=>
        object(PhpAmqpLib\Wire\AMQPReader)#6 (9) {
          ["str":protected]=>
          string(0) ""
          ["str_length":protected]=>
          int(0)
          ["offset":protected]=>
          int(528)
          ["bitcount":protected]=>
          int(0)
          ["is64bits":protected]=>
          bool(true)
          ["timeout":protected]=>
          int(0)
          ["bits":protected]=>
          int(0)
          ["io":protected]=>
          NULL
          ["isLittleEndian":protected]=>
          bool(true)
        }
        ["connection_block_handler":"PhpAmqpLib\Connection\AbstractConnection":private]=>
        NULL
        ["connection_unblock_handler":"PhpAmqpLib\Connection\AbstractConnection":private]=>
        NULL
        ["prepare_content_cache":"PhpAmqpLib\Connection\AbstractConnection":private]=>
        array(0) {
        }
        ["prepare_content_cache_max_size":"PhpAmqpLib\Connection\AbstractConnection":private]=>
        int(100)
        ["frame_queue":protected]=>
        array(0) {
        }
        ["method_queue":protected]=>
        array(0) {
        }
        ["auto_decode":protected]=>
        bool(false)
        ["amqp_protocol_header":protected]=>
"
        ["debug":protected]=>
        object(PhpAmqpLib\Helper\DebugHelper)#10 (2) {
          ["debug":protected]=>
          bool(false)
          ["PROTOCOL_CONSTANTS_CLASS":protected]=>
          string(28) "PhpAmqpLib\Wire\Constants091"
        }
        ["connection":protected]=>
        *RECURSION*
        ["protocolVersion":protected]=>
        string(5) "0.9.1"
        ["maxBodySize":protected]=>
        NULL
        ["protocolWriter":protected]=>
        object(PhpAmqpLib\Helper\Protocol\Protocol091)#11 (0) {
        }
        ["waitHelper":protected]=>
        object(PhpAmqpLib\Helper\Protocol\Wait091)#12 (1) {
          ["wait":protected]=>
          array(64) {
            ["connection.start"]=>
            string(5) "10,10"
            ["connection.start_ok"]=>
            string(5) "10,11"
            ["connection.secure"]=>
            string(5) "10,20"
            ["connection.secure_ok"]=>
            string(5) "10,21"
            ["connection.tune"]=>
            string(5) "10,30"
            ["connection.tune_ok"]=>
            string(5) "10,31"
            ["connection.open"]=>
            string(5) "10,40"
            ["connection.open_ok"]=>
            string(5) "10,41"
            ["connection.close"]=>
            string(5) "10,50"
            ["connection.close_ok"]=>
            string(5) "10,51"
            ["connection.blocked"]=>
            string(5) "10,60"
            ["connection.unblocked"]=>
            string(5) "10,61"
            ["channel.open"]=>
            string(5) "20,10"
            ["channel.open_ok"]=>
            string(5) "20,11"
            ["channel.flow"]=>
            string(5) "20,20"
            ["channel.flow_ok"]=>
            string(5) "20,21"
            ["channel.close"]=>
            string(5) "20,40"
            ["channel.close_ok"]=>
            string(5) "20,41"
            ["access.request"]=>
            string(5) "30,10"
            ["access.request_ok"]=>
            string(5) "30,11"
            ["exchange.declare"]=>
            string(5) "40,10"
            ["exchange.declare_ok"]=>
            string(5) "40,11"
            ["exchange.delete"]=>
            string(5) "40,20"
            ["exchange.delete_ok"]=>
            string(5) "40,21"
            ["exchange.bind"]=>
            string(5) "40,30"
            ["exchange.bind_ok"]=>
            string(5) "40,31"
            ["exchange.unbind"]=>
            string(5) "40,40"
            ["exchange.unbind_ok"]=>
            string(5) "40,51"
            ["queue.declare"]=>
            string(5) "50,10"
            ["queue.declare_ok"]=>
            string(5) "50,11"
            ["queue.bind"]=>
            string(5) "50,20"
            ["queue.bind_ok"]=>
            string(5) "50,21"
            ["queue.purge"]=>
            string(5) "50,30"
            ["queue.purge_ok"]=>
            string(5) "50,31"
            ["queue.delete"]=>
            string(5) "50,40"
            ["queue.delete_ok"]=>
            string(5) "50,41"
            ["queue.unbind"]=>
            string(5) "50,50"
            ["queue.unbind_ok"]=>
            string(5) "50,51"
            ["basic.qos"]=>
            string(5) "60,10"
            ["basic.qos_ok"]=>
            string(5) "60,11"
            ["basic.consume"]=>
            string(5) "60,20"
            ["basic.consume_ok"]=>
            string(5) "60,21"
            ["basic.cancel"]=>
            string(5) "60,30"
            ["basic.cancel_ok"]=>
            string(5) "60,31"
            ["basic.publish"]=>
            string(5) "60,40"
            ["basic.return"]=>
            string(5) "60,50"
            ["basic.deliver"]=>
            string(5) "60,60"
            ["basic.get"]=>
            string(5) "60,70"
            ["basic.get_ok"]=>
            string(5) "60,71"
            ["basic.get_empty"]=>
            string(5) "60,72"
            ["basic.ack"]=>
            string(5) "60,80"
            ["basic.reject"]=>
            string(5) "60,90"
            ["basic.recover_async"]=>
            string(6) "60,100"
            ["basic.recover"]=>
            string(6) "60,110"
            ["basic.recover_ok"]=>
            string(6) "60,111"
            ["basic.nack"]=>
            string(6) "60,120"
            ["tx.select"]=>
            string(5) "90,10"
            ["tx.select_ok"]=>
            string(5) "90,11"
            ["tx.commit"]=>
            string(5) "90,20"
            ["tx.commit_ok"]=>
            string(5) "90,21"
            ["tx.rollback"]=>
            string(5) "90,30"
            ["tx.rollback_ok"]=>
            string(5) "90,31"
            ["confirm.select"]=>
            string(5) "85,10"
            ["confirm.select_ok"]=>
            string(5) "85,11"
          }
        }
        ["methodMap":protected]=>
        object(PhpAmqpLib\Helper\Protocol\MethodMap091)#13 (1) {
          ["method_map":protected]=>
          array(64) {
            ["10,10"]=>
            string(16) "connection_start"
            ["10,11"]=>
            string(19) "connection_start_ok"
            ["10,20"]=>
            string(17) "connection_secure"
            ["10,21"]=>
            string(20) "connection_secure_ok"
            ["10,30"]=>
            string(15) "connection_tune"
            ["10,31"]=>
            string(18) "connection_tune_ok"
            ["10,40"]=>
            string(15) "connection_open"
            ["10,41"]=>
            string(18) "connection_open_ok"
            ["10,50"]=>
            string(16) "connection_close"
            ["10,51"]=>
            string(19) "connection_close_ok"
            ["10,60"]=>
            string(18) "connection_blocked"
            ["10,61"]=>
            string(20) "connection_unblocked"
            ["20,10"]=>
            string(12) "channel_open"
            ["20,11"]=>
            string(15) "channel_open_ok"
            ["20,20"]=>
            string(12) "channel_flow"
            ["20,21"]=>
            string(15) "channel_flow_ok"
            ["20,40"]=>
            string(13) "channel_close"
            ["20,41"]=>
            string(16) "channel_close_ok"
            ["30,10"]=>
            string(14) "access_request"
            ["30,11"]=>
            string(17) "access_request_ok"
            ["40,10"]=>
            string(16) "exchange_declare"
            ["40,11"]=>
            string(19) "exchange_declare_ok"
            ["40,20"]=>
            string(15) "exchange_delete"
            ["40,21"]=>
            string(18) "exchange_delete_ok"
            ["40,30"]=>
            string(13) "exchange_bind"
            ["40,31"]=>
            string(16) "exchange_bind_ok"
            ["40,40"]=>
            string(15) "exchange_unbind"
            ["40,51"]=>
            string(18) "exchange_unbind_ok"
            ["50,10"]=>
            string(13) "queue_declare"
            ["50,11"]=>
            string(16) "queue_declare_ok"
            ["50,20"]=>
            string(10) "queue_bind"
            ["50,21"]=>
            string(13) "queue_bind_ok"
            ["50,30"]=>
            string(11) "queue_purge"
            ["50,31"]=>
            string(14) "queue_purge_ok"
            ["50,40"]=>
            string(12) "queue_delete"
            ["50,41"]=>
            string(15) "queue_delete_ok"
            ["50,50"]=>
            string(12) "queue_unbind"
            ["50,51"]=>
            string(15) "queue_unbind_ok"
            ["60,10"]=>
            string(9) "basic_qos"
            ["60,11"]=>
            string(12) "basic_qos_ok"
            ["60,20"]=>
            string(13) "basic_consume"
            ["60,21"]=>
            string(16) "basic_consume_ok"
            ["60,30"]=>
            string(24) "basic_cancel_from_server"
            ["60,31"]=>
            string(15) "basic_cancel_ok"
            ["60,40"]=>
            string(13) "basic_publish"
            ["60,50"]=>
            string(12) "basic_return"
            ["60,60"]=>
            string(13) "basic_deliver"
            ["60,70"]=>
            string(9) "basic_get"
            ["60,71"]=>
            string(12) "basic_get_ok"
            ["60,72"]=>
            string(15) "basic_get_empty"
            ["60,80"]=>
            string(21) "basic_ack_from_server"
            ["60,90"]=>
            string(12) "basic_reject"
            ["60,100"]=>
            string(19) "basic_recover_async"
            ["60,110"]=>
            string(13) "basic_recover"
            ["60,111"]=>
            string(16) "basic_recover_ok"
            ["60,120"]=>
            string(22) "basic_nack_from_server"
            ["90,10"]=>
            string(9) "tx_select"
            ["90,11"]=>
            string(12) "tx_select_ok"
            ["90,20"]=>
            string(9) "tx_commit"
            ["90,21"]=>
            string(12) "tx_commit_ok"
            ["90,30"]=>
            string(11) "tx_rollback"
            ["90,31"]=>
            string(14) "tx_rollback_ok"
            ["85,10"]=>
            string(14) "confirm_select"
            ["85,11"]=>
            string(17) "confirm_select_ok"
          }
        }
        ["channel_id":protected]=>
        int(0)
        ["msg_property_reader":protected]=>
        object(PhpAmqpLib\Wire\AMQPReader)#7 (9) {
          ["str":protected]=>
          NULL
          ["str_length":protected]=>
          int(0)
          ["offset":protected]=>
          int(0)
          ["bitcount":protected]=>
          int(0)
          ["is64bits":protected]=>
          bool(true)
          ["timeout":protected]=>
          int(0)
          ["bits":protected]=>
          int(0)
          ["io":protected]=>
          NULL
          ["isLittleEndian":protected]=>
          bool(true)
        }
        ["wait_content_reader":protected]=>
        object(PhpAmqpLib\Wire\AMQPReader)#8 (9) {
          ["str":protected]=>
          NULL
          ["str_length":protected]=>
          int(0)
          ["offset":protected]=>
          int(0)
          ["bitcount":protected]=>
          int(0)
          ["is64bits":protected]=>
          bool(true)
          ["timeout":protected]=>
          int(0)
          ["bits":protected]=>
          int(0)
          ["io":protected]=>
          NULL
          ["isLittleEndian":protected]=>
          bool(true)
        }
        ["dispatch_reader":protected]=>
        object(PhpAmqpLib\Wire\AMQPReader)#9 (9) {
          ["str":protected]=>
          string(0) ""
          ["str_length":protected]=>
          int(0)
          ["offset":protected]=>
          int(1)
          ["bitcount":protected]=>
          int(0)
          ["is64bits":protected]=>
          bool(true)
          ["timeout":protected]=>
          int(0)
          ["bits":protected]=>
          int(0)
          ["io":protected]=>
          NULL
          ["isLittleEndian":protected]=>
          bool(true)
        }
      }
      ["protocolVersion":protected]=>
      string(5) "0.9.1"
      ["maxBodySize":protected]=>
      NULL
      ["protocolWriter":protected]=>
      object(PhpAmqpLib\Helper\Protocol\Protocol091)#20 (0) {
      }
      ["waitHelper":protected]=>
      object(PhpAmqpLib\Helper\Protocol\Wait091)#21 (1) {
        ["wait":protected]=>
        array(64) {
          ["connection.start"]=>
          string(5) "10,10"
          ["connection.start_ok"]=>
          string(5) "10,11"
          ["connection.secure"]=>
          string(5) "10,20"
          ["connection.secure_ok"]=>
          string(5) "10,21"
          ["connection.tune"]=>
          string(5) "10,30"
          ["connection.tune_ok"]=>
          string(5) "10,31"
          ["connection.open"]=>
          string(5) "10,40"
          ["connection.open_ok"]=>
          string(5) "10,41"
          ["connection.close"]=>
          string(5) "10,50"
          ["connection.close_ok"]=>
          string(5) "10,51"
          ["connection.blocked"]=>
          string(5) "10,60"
          ["connection.unblocked"]=>
          string(5) "10,61"
          ["channel.open"]=>
          string(5) "20,10"
          ["channel.open_ok"]=>
          string(5) "20,11"
          ["channel.flow"]=>
          string(5) "20,20"
          ["channel.flow_ok"]=>
          string(5) "20,21"
          ["channel.close"]=>
          string(5) "20,40"
          ["channel.close_ok"]=>
          string(5) "20,41"
          ["access.request"]=>
          string(5) "30,10"
          ["access.request_ok"]=>
          string(5) "30,11"
          ["exchange.declare"]=>
          string(5) "40,10"
          ["exchange.declare_ok"]=>
          string(5) "40,11"
          ["exchange.delete"]=>
          string(5) "40,20"
          ["exchange.delete_ok"]=>
          string(5) "40,21"
          ["exchange.bind"]=>
          string(5) "40,30"
          ["exchange.bind_ok"]=>
          string(5) "40,31"
          ["exchange.unbind"]=>
          string(5) "40,40"
          ["exchange.unbind_ok"]=>
          string(5) "40,51"
          ["queue.declare"]=>
          string(5) "50,10"
          ["queue.declare_ok"]=>
          string(5) "50,11"
          ["queue.bind"]=>
          string(5) "50,20"
          ["queue.bind_ok"]=>
          string(5) "50,21"
          ["queue.purge"]=>
          string(5) "50,30"
          ["queue.purge_ok"]=>
          string(5) "50,31"
          ["queue.delete"]=>
          string(5) "50,40"
          ["queue.delete_ok"]=>
          string(5) "50,41"
          ["queue.unbind"]=>
          string(5) "50,50"
          ["queue.unbind_ok"]=>
          string(5) "50,51"
          ["basic.qos"]=>
          string(5) "60,10"
          ["basic.qos_ok"]=>
          string(5) "60,11"
          ["basic.consume"]=>
          string(5) "60,20"
          ["basic.consume_ok"]=>
          string(5) "60,21"
          ["basic.cancel"]=>
          string(5) "60,30"
          ["basic.cancel_ok"]=>
          string(5) "60,31"
          ["basic.publish"]=>
          string(5) "60,40"
          ["basic.return"]=>
          string(5) "60,50"
          ["basic.deliver"]=>
          string(5) "60,60"
          ["basic.get"]=>
          string(5) "60,70"
          ["basic.get_ok"]=>
          string(5) "60,71"
          ["basic.get_empty"]=>
          string(5) "60,72"
          ["basic.ack"]=>
          string(5) "60,80"
          ["basic.reject"]=>
          string(5) "60,90"
          ["basic.recover_async"]=>
          string(6) "60,100"
          ["basic.recover"]=>
          string(6) "60,110"
          ["basic.recover_ok"]=>
          string(6) "60,111"
          ["basic.nack"]=>
          string(6) "60,120"
          ["tx.select"]=>
          string(5) "90,10"
          ["tx.select_ok"]=>
          string(5) "90,11"
          ["tx.commit"]=>
          string(5) "90,20"
          ["tx.commit_ok"]=>
          string(5) "90,21"
          ["tx.rollback"]=>
          string(5) "90,30"
          ["tx.rollback_ok"]=>
          string(5) "90,31"
          ["confirm.select"]=>
          string(5) "85,10"
          ["confirm.select_ok"]=>
          string(5) "85,11"
        }
      }
      ["methodMap":protected]=>
      object(PhpAmqpLib\Helper\Protocol\MethodMap091)#22 (1) {
        ["method_map":protected]=>
        array(64) {
          ["10,10"]=>
          string(16) "connection_start"
          ["10,11"]=>
          string(19) "connection_start_ok"
          ["10,20"]=>
          string(17) "connection_secure"
          ["10,21"]=>
          string(20) "connection_secure_ok"
          ["10,30"]=>
          string(15) "connection_tune"
          ["10,31"]=>
          string(18) "connection_tune_ok"
          ["10,40"]=>
          string(15) "connection_open"
          ["10,41"]=>
          string(18) "connection_open_ok"
          ["10,50"]=>
          string(16) "connection_close"
          ["10,51"]=>
          string(19) "connection_close_ok"
          ["10,60"]=>
          string(18) "connection_blocked"
          ["10,61"]=>
          string(20) "connection_unblocked"
          ["20,10"]=>
          string(12) "channel_open"
          ["20,11"]=>
          string(15) "channel_open_ok"
          ["20,20"]=>
          string(12) "channel_flow"
          ["20,21"]=>
          string(15) "channel_flow_ok"
          ["20,40"]=>
          string(13) "channel_close"
          ["20,41"]=>
          string(16) "channel_close_ok"
          ["30,10"]=>
          string(14) "access_request"
          ["30,11"]=>
          string(17) "access_request_ok"
          ["40,10"]=>
          string(16) "exchange_declare"
          ["40,11"]=>
          string(19) "exchange_declare_ok"
          ["40,20"]=>
          string(15) "exchange_delete"
          ["40,21"]=>
          string(18) "exchange_delete_ok"
          ["40,30"]=>
          string(13) "exchange_bind"
          ["40,31"]=>
          string(16) "exchange_bind_ok"
          ["40,40"]=>
          string(15) "exchange_unbind"
          ["40,51"]=>
          string(18) "exchange_unbind_ok"
          ["50,10"]=>
          string(13) "queue_declare"
          ["50,11"]=>
          string(16) "queue_declare_ok"
          ["50,20"]=>
          string(10) "queue_bind"
          ["50,21"]=>
          string(13) "queue_bind_ok"
          ["50,30"]=>
          string(11) "queue_purge"
          ["50,31"]=>
          string(14) "queue_purge_ok"
          ["50,40"]=>
          string(12) "queue_delete"
          ["50,41"]=>
          string(15) "queue_delete_ok"
          ["50,50"]=>
          string(12) "queue_unbind"
          ["50,51"]=>
          string(15) "queue_unbind_ok"
          ["60,10"]=>
          string(9) "basic_qos"
          ["60,11"]=>
          string(12) "basic_qos_ok"
          ["60,20"]=>
          string(13) "basic_consume"
          ["60,21"]=>
          string(16) "basic_consume_ok"
          ["60,30"]=>
          string(24) "basic_cancel_from_server"
          ["60,31"]=>
          string(15) "basic_cancel_ok"
          ["60,40"]=>
          string(13) "basic_publish"
          ["60,50"]=>
          string(12) "basic_return"
          ["60,60"]=>
          string(13) "basic_deliver"
          ["60,70"]=>
          string(9) "basic_get"
          ["60,71"]=>
          string(12) "basic_get_ok"
          ["60,72"]=>
          string(15) "basic_get_empty"
          ["60,80"]=>
          string(21) "basic_ack_from_server"
          ["60,90"]=>
          string(12) "basic_reject"
          ["60,100"]=>
          string(19) "basic_recover_async"
          ["60,110"]=>
          string(13) "basic_recover"
          ["60,111"]=>
          string(16) "basic_recover_ok"
          ["60,120"]=>
          string(22) "basic_nack_from_server"
          ["90,10"]=>
          string(9) "tx_select"
          ["90,11"]=>
          string(12) "tx_select_ok"
          ["90,20"]=>
          string(9) "tx_commit"
          ["90,21"]=>
          string(12) "tx_commit_ok"
          ["90,30"]=>
          string(11) "tx_rollback"
          ["90,31"]=>
          string(14) "tx_rollback_ok"
          ["85,10"]=>
          string(14) "confirm_select"
          ["85,11"]=>
          string(17) "confirm_select_ok"
        }
      }
      ["channel_id":protected]=>
      int(1)
      ["msg_property_reader":protected]=>
      object(PhpAmqpLib\Wire\AMQPReader)#16 (9) {
        ["str":protected]=>
        string(0) ""
        ["str_length":protected]=>
        int(0)
        ["offset":protected]=>
        int(3)
        ["bitcount":protected]=>
        int(0)
        ["is64bits":protected]=>
        bool(true)
        ["timeout":protected]=>
        int(0)
        ["bits":protected]=>
        int(0)
        ["io":protected]=>
        NULL
        ["isLittleEndian":protected]=>
        bool(true)
      }
      ["wait_content_reader":protected]=>
      object(PhpAmqpLib\Wire\AMQPReader)#17 (9) {
        ["str":protected]=>
        string(0) ""
        ["str_length":protected]=>
        int(0)
        ["offset":protected]=>
        int(12)
        ["bitcount":protected]=>
        int(0)
        ["is64bits":protected]=>
        bool(true)
        ["timeout":protected]=>
        int(0)
        ["bits":protected]=>
        int(0)
        ["io":protected]=>
        NULL
        ["isLittleEndian":protected]=>
        bool(true)
      }
      ["dispatch_reader":protected]=>
      object(PhpAmqpLib\Wire\AMQPReader)#18 (9) {
        ["str":protected]=>
        string(0) ""
        ["str_length":protected]=>
        int(0)
        ["offset":protected]=>
        int(50)
        ["bitcount":protected]=>
        int(0)
        ["is64bits":protected]=>
        bool(true)
        ["timeout":protected]=>
        int(0)
        ["bits":protected]=>
        int(0)
        ["io":protected]=>
        NULL
        ["isLittleEndian":protected]=>
        bool(true)
      }
    }
    ["consumer_tag"]=>
    string(31) "amq.ctag-6srDIV9Tbg1G-wVycyPgzQ"
    ["delivery_tag"]=>
    string(1) "1"
    ["redelivered"]=>
    bool(false)
    ["exchange"]=>
    string(0) ""
    ["routing_key"]=>
    string(7) "billing"
  }
  ["prop_types":protected]=>
  array(14) {
    ["content_type"]=>
    string(8) "shortstr"
    ["content_encoding"]=>
    string(8) "shortstr"
    ["application_headers"]=>
    string(12) "table_object"
    ["delivery_mode"]=>
    string(5) "octet"
    ["priority"]=>
    string(5) "octet"
    ["correlation_id"]=>
    string(8) "shortstr"
    ["reply_to"]=>
    string(8) "shortstr"
    ["expiration"]=>
    string(8) "shortstr"
    ["message_id"]=>
    string(8) "shortstr"
    ["timestamp"]=>
    string(9) "timestamp"
    ["type"]=>
    string(8) "shortstr"
    ["user_id"]=>
    string(8) "shortstr"
    ["app_id"]=>
    string(8) "shortstr"
    ["cluster_id"]=>
    string(8) "shortstr"
  }
  ["properties":"PhpAmqpLib\Wire\GenericContent":private]=>
  array(1) {
    ["delivery_mode"]=>
    int(2)
  }
  ["serialized_properties":"PhpAmqpLib\Wire\GenericContent":private]=>
  NULL
}';
var_dump(json_decode($value));
exit();	
