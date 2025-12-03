<?php

namespace App\Controller;

use App\Component\SNMP\Walker;
use App\ValueObject\Hostname;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SNMPController extends AbstractController
{
    #[Route('snmp/walk/{hostname}', name: 'snmp_walk')]
    public function walk(
        string $hostname,
        Walker $walker,
    ): Response {
        $hostname = new Hostname($hostname);
        $communityName = 'GarageSwSNMP1';
        $objectId = '';
        $data = $walker->grabData($hostname, $communityName, $objectId);

        foreach ($data->content as $item) {
            foreach ($item as $oid => $value) {
                if (\preg_match('/.*\.10$/', $oid)) {
                    print $oid . '----' . $value . '</br>';
                }
            }
        }

        return new Response(\var_dump($data->content));
    }
}
