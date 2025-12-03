<?php

namespace App\Controller;

use PDO;
use Symfony\Component\HttpFoundation\Response;

class MyTestController
{
    public function transferMoney($userFrom, $userTo, $money)
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=moneytransfer', 'root', '');
        $pdo->beginTransaction();
        try {
            $stmtWithdraw = $pdo->prepare('INSERT INTO userMoney SET money = :money, idUser = :idUser on duplicate key update money -= :money', [
                ':money' => $money,
                ':idUser' => $userFrom,
            ]);
            $stmtAdd = $pdo->prepare(
                'INSERT INTO userMoney SET money=:money, idUser = :idUser on duplicate key update money += :money', [
                    ':money' => $money,
                    ':idUser' => $userTo,
                ]
            );

            $stmtWithdraw->execute();
            $stmtAdd->execute();

            $pdo->commit();
        } catch (\PDOException $e) {
            $pdo->rollBack();
        }

    }

    public function searchByEmail($email): Response
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=moneytransfer', 'root', '');
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $data = $stmt->execute(['email' => $email]);

        return new Response(json_encode($data));
    }
}
