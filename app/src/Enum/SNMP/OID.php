<?php

namespace App\Enum\SNMP;

enum OID: string
{
    case OID_ifDescr = '1.3.6.1.2.1.2.2.1.2';
    case OID_ifHCIn = '1.3.6.1.2.1.31.1.1.1.10';
    case OID_ifHCOut = '1.3.6.1.2.1.31.1.1.1.11';
    case OID_SYS_CPU_LOAD = '1.3.6.1.2.1.25.3.3.1.2.1';
    case OID_SYS_MEMORY_TOTAL = '1.3.6.1.2.1.25.2.3.1.5.65536';
    case OID_SYS_MEMORY_USED = '1.3.6.1.2.1.25.2.3.1.6.65536';
    case OID_SYS_UPTIME = '1.3.6.1.2.1.1.3.0';
    case OID_SYS_TEMPERATURE = '1.3.6.1.4.1.14988.1.1.3.10.0';
}
