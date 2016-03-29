
<form method="POST" action="">
    <p> Сумма покупки</p>
    <input type="text" name="price">
    <p>Первоначальный взнос в процентах от 0 до 100</p>
    <input type="text" name="first_installment">
    <p>Срок кредитования (от 1  до 7) лет</p>
    <input type="text" name="loan_terms"><br><br>
    <input type="submit">
</form>
<?php

if(!empty($_POST)){

    //print_r($_POST);
    $price = $_POST['price'];
    $first_installment = $_POST['first_installment'];
    $loan_terms = $_POST['loan_terms'];

    $arr_loan_terms = [
        1 => 9,
        2 => 11,
        3 => 13,
        4 => 15,
        5 => 17,
        6 => 19,
        7 => 21
    ];
    //print_r($arr_loan_terms);
    //echo "'$arr_loan_terms['$loan_terms']";

    if($loan_terms > 0 && $loan_terms < 8){
        $balanceWithOutProcent = $price - (($first_installment / 100) * $price);

        $balanceWithProcent = $balanceWithOutProcent * ($arr_loan_terms[$loan_terms] / 100);
        $balanceWithProcent = $arr_loan_terms[$loan_terms] / 100 * $balanceWithOutProcent * $loan_terms +  $balanceWithOutProcent;
        //$balanceInMounth = $balanceWithOutProcent * ($arr_loan_terms[$loan_terms] / 100) / $loan_terms;
        //$balance3 = $balance * ($arr_loan_terms[$loan_terms] / 100) / $loan_terms;
        $balanceInMounth = $balanceWithProcent / (12 * $loan_terms );
        echo "без процента $balanceWithOutProcent <br>";
        echo "с процентом $balanceWithProcent <br>";
        echo "в месяц $balanceInMounth <br>";

        $cols = 1;
        $rows = $loan_terms * 12;
        $mounth = 1;
        echo "<table>";
        echo "<tr>";
        echo "<th>Месяц </th>";
        echo "<th>Платеж </th>";
        echo "<th>Остаток</th>";
        echo "</tr>";
        for($i = 0; $i < $rows; $i++){
            echo "<tr>";
            for($j = 0; $j < $cols; $j++){

                echo "<td>$mounth Месяц</td>";
                echo "<td>$balanceInMounth грн</td>";
                echo "<td>$balanceWithProcent</td>";
                $balanceWithProcent -= $balanceInMounth;
                $mounth++;
            }
            echo "</tr>";
        }
        echo "</table>";
    }else{
        echo "Срок кредитования должен быть (от 1  до 7) лет";
    }
}else{
    $price = '';
    $first_installment = '';
    $loan_terms = '';

}


?>



