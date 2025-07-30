<?php
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<Autodiscover xmlns="http://schemas.microsoft.com/exchange/autodiscover/responseschema/2006">
	<Response xmlns="{{$schema}}">
		<User>
			<DisplayName>{{$email}}</DisplayName>
		</User>

		@isset($config["IMAP"])
			<Account>
				<AccountType>email</AccountType>
				<Action>settings</Action>

				<Protocol>
					<Type>IMAP</Type>
					<TTL>1</TTL>

					<Server>{{$config["IMAP"]["HOST"]}}</Server>
					<Port>{{$config["IMAP"]["PORT"]}}</Port>

					<LoginName>{{$config["IMAP"]["USERNAME_TYPE"] === "EMAIL" ? $email : $username}}</LoginName>

					<DomainRequired>{{$config["IMAP"]["USERNAME_TYPE"] === "EMAIL" ? "on" : "off"}}</DomainRequired>
					<DomainName>{{$domain}}</DomainName>

					<SPA>off</SPA>
					<SSL>{{$config["IMAP"]["ENCRYPTION"] === "SSL" ? "on" : "off"}}</SSL>
					<AuthRequired>on</AuthRequired>
				</Protocol>
			</Account>
		@endisset

		@isset($config["SMTP"])
			<Account>
				<AccountType>email</AccountType>
				<Action>settings</Action>

				<Protocol>
					<Type>SMTP</Type>
					<TTL>1</TTL>

					<Server>{{$config["SMTP"]["HOST"]}}</Server>
					<Port>{{$config["SMTP"]["PORT"]}}</Port>

					<LoginName>{{$config["SMTP"]["USERNAME_TYPE"] === "EMAIL" ? $email : $username}}</LoginName>

					<DomainRequired>{{$config["SMTP"]["USERNAME_TYPE"] === "EMAIL" ? "on" : "off"}}</DomainRequired>
					<DomainName>{{$domain}}</DomainName>

					<SPA>off</SPA>
					<SSL>{{$config["SMTP"]["ENCRYPTION"] === "SSL" ? "on" : "off"}}</SSL>
					<AuthRequired>on</AuthRequired>
				</Protocol>
			</Account>
		@endisset
	</Response>
</Autodiscover>