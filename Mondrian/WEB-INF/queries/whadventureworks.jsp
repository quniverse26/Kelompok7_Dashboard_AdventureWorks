<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
<%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>


<jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver" 
jdbcUrl="jdbc:mysql://localhost/adventureworks-dw?user=root&password=" catalogUri="/WEB-INF/queries/dwadventureworks.xml">

select {[Measures].[jml transaksi]} ON COLUMNS,
  {([Transaksi],[Time].[All times],[Product])} ON ROWS
from [Produksi]


</jp:mondrianQuery>





<c:set var="title01" scope="session">Query ADVENTURE WORKS using Mondrian OLAP</c:set>
