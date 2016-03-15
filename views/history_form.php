<table class = "table table-striped">
    <thead>
        <tr>
            <th>Transaction Type</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th> 
            <th>Price</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
            foreach($History as $position)
            {
                echo("<tr>");
                echo("<td class=\"text-left\">" . $position["Transaction"] . "</td>");
                echo("<td class=\"text-left\">" . date('d/m/y, g:i A', strtotime($position["Created_at"])) . "</td>");
                echo("<td class=\"text-left\">" . $position["Symbol"] . "</td>");
                echo("<td class=\"text-left\">" . $position["Shares"] . "</td>");
                echo("<td class=\"text-left\">" . number_format($position["Price"],2) . "</td>");
                echo("</tr>");
            }
        ?>
    </tbody>
</table>