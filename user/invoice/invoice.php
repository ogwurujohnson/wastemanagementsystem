<!DOCTYPE html>
<html>
<head>
	<title>Gafista - Invoice</title>
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!-- <link rel="stylesheet" href="sass/main.css" media="screen" charset="utf-8"/> -->
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="content-type" content="text-html; charset=utf-8">
	<style type="text/css">
		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed,
		figure, figcaption, footer, header, hgroup,
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font: inherit;
			font-size: 100%;
			vertical-align: baseline;
		}

		html {
			line-height: 1;
		}

		ol, ul {
			list-style: none;
		}

		table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		caption, th, td {
			text-align: left;
			font-weight: normal;
			vertical-align: middle;
		}

		q, blockquote {
			quotes: none;
		}
		q:before, q:after, blockquote:before, blockquote:after {
			content: "";
			content: none;
		}

		a img {
			border: none;
		}

		article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
			display: block;
		}

		body {
			font-family: 'Source Sans Pro', sans-serif;
			font-weight: 300;
			font-size: 12px;
			margin: 0;
			padding: 0;
		}
		body a {
			text-decoration: none;
			color: inherit;
		}
		body a:hover {
			color: inherit;
			opacity: 0.7;
		}
		body .container {
			min-width: 500px;
			margin: 0 auto;
			padding: 0 20px;
		}
		body .clearfix:after {
			content: "";
			display: table;
			clear: both;
		}
		body .left {
			float: left;
		}
		body .right {
			float: right;
		}
		body .helper {
			display: inline-block;
			height: 100%;
			vertical-align: middle;
		}
		body .no-break {
			page-break-inside: avoid;
		}

		header {
			margin-top: 20px;
			margin-bottom: 50px;
		}
		header figure {
			float: left;
			width: 60px;
			height: 60px;
			margin-right: 10px;
			background-color: #8BC34A;
			border-radius: 50%;
			text-align: center;
		}
		header figure img {
			margin-top: 13px;
		}
		header .company-address {
			float: left;
			max-width: 150px;
			line-height: 1.7em;
		}
		header .company-address .title {
			color: #8BC34A;
			font-weight: 400;
			font-size: 1.5em;
			text-transform: uppercase;
		}
		header .company-contact {
			float: right;
			height:px;
			padding: 0 10px;
			background-color:#3f9a76;
			color: white;
		}
		header .company-contact span {
			display: inline-block;
			vertical-align: middle;
		}
		header .company-contact .circle {
			width: 20px;
			height: 20px;
			background-color: white;
			border-radius: 50%;
			text-align: center;
		}
		header .company-contact .circle img {
			vertical-align: middle;
		}
		header .company-contact .phone {
			height: 100%;
			margin-right: 20px;
		}
		header .company-contact .email {
			height: 100%;
			min-width: 100px;
			text-align: right;
		}

		section .details {
			margin-bottom: 55px;
		}
		section .details .client {
			width: 50%;
			line-height: 20px;
		}
		section .details .client .name {
			color: #8BC34A;
		}
		section .details .data {
			width: 50%;
			text-align: right;
		}
		section .details .title {
			margin-bottom: 15px;
			color: #8BC34A;
			font-size: 3em;
			font-weight: 400;
			text-transform: uppercase;
		}
		section table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			font-size: 0.9166em;
		}
		section table .qty, section table .unit, section table .total {
			width: 15%;
		}
		section table .desc {
			width: 55%;
		}
		section table thead {
			display: table-header-group;
			vertical-align: middle;
			border-color: inherit;
		}
		section table thead th {
			padding: 5px 10px;
			background: #8BC34A;
			border-bottom: 5px solid #FFFFFF;
			border-right: 4px solid #FFFFFF;
			text-align: right;
			color: white;
			font-weight: 400;
			text-transform: uppercase;
		}
		section table thead th:last-child {
			border-right: none;
		}
		section table thead .desc {
			text-align: left;
		}
		section table thead .qty {
			text-align: center;
		}
		section table tbody td {
			padding: 10px;
			background: #E8F3DB;
			color: #777777;
			text-align: right;
			border-bottom: 5px solid #FFFFFF;
			border-right: 4px solid #E8F3DB;
		}
		section table tbody td:last-child {
			border-right: none;
		}
		section table tbody h3 {
			margin-bottom: 5px;
			color: #8BC34A;
			font-weight: 600;
		}
		section table tbody .desc {
			text-align: left;
		}
		section table tbody .qty {
			text-align: center;
		}
		section table.grand-total {
			margin-bottom: 45px;
		}
		section table.grand-total td {
			padding: 5px 10px;
			border: none;
			color: #777777;
			text-align: right;
		}
		section table.grand-total .desc {
			background-color: transparent;
		}
		section table.grand-total tr:last-child td {
			font-weight: 600;
			color: #8BC34A;
			font-size: 1.18181818181818em;
		}

		footer {
			margin-bottom: 20px;
		}
		footer .thanks {
			margin-bottom: 40px;
			color: #8BC34A;
			font-size: 1.16666666666667em;
			font-weight: 600;
		}
		footer .notice {
			margin-bottom: 25px;
		}
		footer .end {
			padding-top: 5px;
			border-top: 2px solid #8BC34A;
			text-align: center;
		}
	</style>
</head>

<body>
	<header class="clearfix">
		<div class="container">
			
			<div class="company-address">
				<h2 class="title"><img src="lawma.png" width="120px" height="50px"/></h2>
				<p>
					3, Otto Road Ijora Olopa,<br>
				Tel: 01-7400795, 8196980, Fax: 01-5844784
				<br>
				E-mail:newlawma@gmail.com<br>
				Website: www.lawma.org
				</p>
			</div>
			<b>LAGOS WASTE MANAGEMENT AUTHORITY </b>






			<div class="company-contact">
				<left><img src="logo.png"/></left>
			
				<br>
				35B, Bode THomas Street, Suru-Lere, Lagos. <br>
				Customers Complainsts Centre<br>
				Agra Office Marine Road, Apapa GRA<br>
			
				<br>
				
				<div class="phone left">
					<span class="circle"><img src="data:image/svg+xml;charset=utf-8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zOnNrZXRjaD0iaHR0cDovL3d3dy5ib2hlbWlhbmNvZGluZy5jb20vc2tldGNoL25zIg0KCSB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjkuNzYycHgiIGhlaWdodD0iOS45NThweCINCgkgdmlld0JveD0iLTQuOTkyIDAuNTE5IDkuNzYyIDkuOTU4IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IC00Ljk5MiAwLjUxOSA5Ljc2MiA5Ljk1OCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8dGl0bGU+RmlsbCAxPC90aXRsZT4NCjxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPg0KPGcgaWQ9IlBhZ2UtMSIgc2tldGNoOnR5cGU9Ik1TUGFnZSI+DQoJPGcgaWQ9IklOVk9JQ0UtMSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTMwMS4wMDAwMDAsIC01NC4wMDAwMDApIiBza2V0Y2g6dHlwZT0iTVNBcnRib2FyZEdyb3VwIj4NCgkJPGcgaWQ9IlpBR0xBVkxKRSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzAuMDAwMDAwLCAxNS4wMDAwMDApIiBza2V0Y2g6dHlwZT0iTVNMYXllckdyb3VwIj4NCgkJCTxnIGlkPSJLT05UQUtUSSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjY3LjAwMDAwMCwgMzUuMDAwMDAwKSIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+DQoJCQkJPGcgaWQ9Ik92YWwtMS1feDJCXy1GaWxsLTEiPg0KCQkJCQk8cGF0aCBpZD0iRmlsbC0xIiBmaWxsPSIjOEJDMzRBIiBkPSJNOC43NjUsMTIuMzc1YzAuMDIsMC4xNjItMC4wMjgsMC4zMDMtMC4xNDMsMC40MjJMNy4yNDYsMTQuMTkNCgkJCQkJCWMtMC4wNjIsMC4wNy0wLjE0MywwLjEzMy0wLjI0MywwLjE4MmMtMC4xMDEsMC4wNDktMC4xOTcsMC4wOC0wLjI5NSwwLjA5NGMtMC4wMDcsMC0wLjAyOCwwLTAuMDYyLDAuMDA0DQoJCQkJCQljLTAuMDM0LDAuMDA1LTAuMDgsMC4wMDgtMC4xMzQsMC4wMDhjLTAuMTMxLDAtMC4zNDMtMC4wMjMtMC42MzUtMC4wNjhjLTAuMjkzLTAuMDQ1LTAuNjUxLTAuMTU4LTEuMDc2LTAuMzM2DQoJCQkJCQljLTAuNDI0LTAuMTgyLTAuOTA0LTAuNDUxLTEuNDQyLTAuODA5Yy0wLjUzNi0wLjM1Ny0xLjEwOS0wLjg1Mi0xLjcxNi0xLjQ3OWMtMC40ODEtMC40ODQtMC44OC0wLjk1LTEuMTk4LTEuMzkzDQoJCQkJCQlDMC4xMjgsOS45NS0wLjEyNSw5LjU0MS0wLjMxOSw5LjE2NGMtMC4xOTMtMC4zNzYtMC4zMzgtMC43MTctMC40MzQtMS4wMjNjLTAuMDk3LTAuMzA2LTAuMTYxLTAuNTctMC4xOTUtMC43OTINCgkJCQkJCWMtMC4wMzUtMC4yMjEtMC4wNS0wLjM5NC0wLjA0Mi0wLjUyMWMwLjAwNy0wLjEyNiwwLjAxLTAuMTk3LDAuMDEtMC4yMTFjMC4wMTQtMC4wOTksMC4wNDQtMC4xOTgsMC4wOTMtMC4zMDENCgkJCQkJCWMwLjA0OS0wLjEwMSwwLjEwOC0wLjE4NCwwLjE3Ni0wLjI0N2wxLjM3NS0xLjQwM2MwLjA5Ny0wLjA5OCwwLjIwNi0wLjE0NywwLjMzLTAuMTQ3YzAuMDksMCwwLjE2OSwwLjAyNiwwLjIzOCwwLjA3OQ0KCQkJCQkJQzEuMyw0LjY0OCwxLjM1OSw0LjcxNCwxLjQwNiw0Ljc5MWwxLjEwNiwyLjE0MWMwLjA2MiwwLjExNCwwLjA4LDAuMjM1LDAuMDUyLDAuMzdDMi41MzgsNy40MzYsMi40NzgsNy41NDgsMi4zODksNy42NA0KCQkJCQkJTDEuODgzLDguMTU3QzEuODY5LDguMTcxLDEuODU2LDguMTk0LDEuODQ2LDguMjI2QzEuODM1LDguMjU2LDEuODMsOC4yODMsMS44Myw4LjMwNGMwLjAyNywwLjE0NywwLjA5LDAuMzE3LDAuMTg3LDAuNTA3DQoJCQkJCQljMC4wODIsMC4xNjksMC4yMSwwLjM3NSwwLjM4MiwwLjYxOGMwLjE3MiwwLjI0MywwLjQxNywwLjUyMSwwLjczNCwwLjgzOWMwLjMxMSwwLjMyMiwwLjU4NSwwLjU3NCwwLjgyOCwwLjc1NQ0KCQkJCQkJYzAuMjQsMC4xNzgsMC40NDMsMC4zMDksMC42MDQsMC4zOTVjMC4xNjIsMC4wODUsMC4yODYsMC4xMzUsMC4zNzIsMC4xNTRsMC4xMjgsMC4wMjRjMC4wMTUsMCwwLjAzOC0wLjAwNiwwLjA2Ny0wLjAxNg0KCQkJCQkJYzAuMDMyLTAuMDEsMC4wNTQtMC4wMjEsMC4wNjctMC4wMzdsMC41ODgtMC42MTJjMC4xMjUtMC4xMTIsMC4yNy0wLjE2OCwwLjQzNi0wLjE2OGMwLjExNywwLDAuMjA3LDAuMDIxLDAuMjc3LDAuMDYxaDAuMDENCgkJCQkJCWwxLjk5NSwxLjIwM0M4LjY1MSwxMi4xMiw4LjczNywxMi4yMzQsOC43NjUsMTIuMzc1TDguNzY1LDEyLjM3NXoiLz4NCgkJCQk8L2c+DQoJCQk8L2c+DQoJCTwvZz4NCgk8L2c+DQo8L2c+DQo8L3N2Zz4NCg==" alt=""><span class="helper"></span></span>
					<a href="tel:602-519-0450">(+234) 8023180905</a>
					<span class="helper"></span>
				</div>
				<div class="email right">
					<span class="circle"><img src="data:image/svg+xml;charset=utf-8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zOnNrZXRjaD0iaHR0cDovL3d3dy5ib2hlbWlhbmNvZGluZy5jb20vc2tldGNoL25zIg0KCSB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE0LjE3M3B4Ig0KCSBoZWlnaHQ9IjE0LjE3M3B4IiB2aWV3Qm94PSIwLjM1NCAtMi4yNzIgMTQuMTczIDE0LjE3MyIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwLjM1NCAtMi4yNzIgMTQuMTczIDE0LjE3MyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSINCgk+DQo8dGl0bGU+ZW1haWwxOTwvdGl0bGU+DQo8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4NCjxnIGlkPSJQYWdlLTEiIHNrZXRjaDp0eXBlPSJNU1BhZ2UiPg0KCTxnIGlkPSJJTlZPSUNFLTEiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC00MTcuMDAwMDAwLCAtNTUuMDAwMDAwKSIgc2tldGNoOnR5cGU9Ik1TQXJ0Ym9hcmRHcm91cCI+DQoJCTxnIGlkPSJaQUdMQVZMSkUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDMwLjAwMDAwMCwgMTUuMDAwMDAwKSIgc2tldGNoOnR5cGU9Ik1TTGF5ZXJHcm91cCI+DQoJCQk8ZyBpZD0iS09OVEFLVEkiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDI2Ny4wMDAwMDAsIDM1LjAwMDAwMCkiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPg0KCQkJCTxnIGlkPSJPdmFsLTEtX3gyQl8tZW1haWwxOSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTE3LjAwMDAwMCwgMC4wMDAwMDApIj4NCgkJCQkJPHBhdGggaWQ9ImVtYWlsMTkiIGZpbGw9IiM4QkMzNEEiIGQ9Ik0zLjM1NCwxNC4yODFoMTQuMTczVjUuMzQ2SDMuMzU0VjE0LjI4MXogTTEwLjQ0LDEwLjg2M0w0LjYyNyw2LjAwOGgxMS42MjZMMTAuNDQsMTAuODYzDQoJCQkJCQl6IE04LjEyNSw5LjgxMkw0LjA1LDEzLjIxN1Y2LjQwOUw4LjEyNSw5LjgxMnogTTguNjUzLDEwLjI1M2wxLjc4OCwxLjQ5M2wxLjc4Ny0xLjQ5M2w0LjAyOSwzLjM2Nkg0LjYyNEw4LjY1MywxMC4yNTN6DQoJCQkJCQkgTTEyLjc1NSw5LjgxMmw0LjA3NS0zLjQwM3Y2LjgwOEwxMi43NTUsOS44MTJ6Ii8+DQoJCQkJPC9nPg0KCQkJPC9nPg0KCQk8L2c+DQoJPC9nPg0KPC9nPg0KPC9zdmc+DQo=" alt=""><span class="helper"></span></span>
					<a href="mailto:company@example.com">company@example.com</a>
					<span class="helper"></span>
					
				</div>
				<br>
				<br>
				<center>
				TO HELP ENSURE A HEALTHY ENVIROMENT <br>FOR CURRENT AND FUTURE  <br>GENERATIONS.
			</center>

			</div>
			
		</div>
	</header>



	<section>
		<div class="container">
			<div class="details clearfix">
				<div class="client left">
					<p>INVOICE TO:</p>
					<p class="name">John Doe</p>
					<p>796 Silver Harbour, TX 79273, US</p>
					<a href="mailto:john@example.com">john@example.com</a>
				</div>
				<div class="data right">
					<div class="title">Invoice 3-2-1</div>
					<div class="date">
						Date of Invoice: 01/06/2014<br>
						Due Date: 30/06/2014<br>
						PROPERTY CODE: GC58723
					</div>
				</div>
			</div>

			<table border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="desc">Description</th>
						<th class="qty">Unit</th>
						<th class="unit">Unit Charge</th>
						<th class="total">Total Charge</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="desc"><h3>Website Design</h3>Creating a recognizable design solution based on the company's existing visual identity</td>
						<td class="qty">30</td>
						<td class="unit">$40.00</td>
						<td class="total">$1,200.00</td>
					</tr>
					<tr>
						<td class="desc"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
						<td class="qty">80</td>
						<td class="unit">$40.00</td>
						<td class="total">$3,200.00</td>
					</tr>
					<tr>
						<td class="desc"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
						<td class="qty">20</td>
						<td class="unit">$40.00</td>
						<td class="total">$800.00</td>
					</tr>
				</tbody>
			</table>
			<div class="no-break">
				<table class="grand-total">
					<tbody>
						<tr>
							<td class="desc"></td>
							<td class="qty"></td>
							<td class="unit">SUBTOTAL:</td>
							<td class="total">$5,200.00</td>
						</tr>
						<tr>
							<td class="desc"></td>
							<td class="qty"></td>
							<td class="unit">TAX 25%:</td>
							<td class="total">$1,300.00</td>
						</tr>
						<tr>
							<td class="desc"></td>
							<td class="unit" colspan="2">GRAND TOTAL:</td>
							<td class="total">$6,500.00</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>


	<footer>
		<div class="container">
			<div class="thanks">Thank you!</div>
			<div class="notice">
				<div><b>NOTICE:</b></div>
			<b>N100 TRANSACTION CHARGE</b>	
				<div>This bill is issued by LAWMA on behalf of the Lagos State Government by virtue of section 18 of the Lagos waste management<br> Law no 27 vol.40 law of lagos State 2007 any person who fails or neglects to pay the tariffsm, fees or charges presented by <br> Lagos Waste Management Authority shall be seemed to commit an offence and is liable to a fine or imprisonment. </div>
			</div>
			<div class="end"> This Invoice was created from <img src="logo.png" width="50px height="40px"> WebApp and is valid without the signature and seal.</div>
		</div>
	</footer>

</body>

</html>