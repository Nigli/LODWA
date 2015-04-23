
<form method="post" action="emailtemplates/rjo_temp.php">
    <select name="contract">
        <option value="wti">WTI Crude Oil</option>
        <option value="emini">Emini S&P 500</option>
    </select>
    
    <select name="month">
        <option value="jan">Jan</option>
        <option value="sep">Sep</option>
    </select>
    <br>
    <select name="choice">
        <option value="buy">BUY</option>
        <option value="sell">SELL</option>
    </select>
    <br>
    <input name="price" type="text"/>
    <br>
    <input type="submit" value="Send" name="submit"/>
</form>