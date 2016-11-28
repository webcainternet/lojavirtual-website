curl https://api.iugu.com/v1/customers -u 15653a119791039173c8d28f6628b790
curl https://api.iugu.com/v1/customers/76C49FA737DC47DAB4D05F1CFB2886F7 -u 15653a119791039173c8d28f6628b790



 curl https://api.iugu.com/v1/customers/76C49FA737DC47DAB4D05F1CFB2886F7/payment_methods  -u 15653a119791039173c8d28f6628b790 -d "description=Meu Cartão de Crédito"








 curl https://api.iugu.com/v1/subscriptions \
    -u 15653a119791039173c8d28f6628b790 \
    -d "plan_identifier=hostlv" \
    -d "customer_id=76C49FA737DC47DAB4D05F1CFB2886F7" \
    -d "subitems[][description]=Item um" \
    -d "subitems[][price_cents]=1000" \
    -d "subitems[][quantity]=1"



LINKS:
https://iugu.com/documentacao/inicio-rapido
https://iugu.com/referencias/api
https://iugu.com/referencias/api#criar-um-cliente <<<<<<<<
https://iugu.com/referencias/exemplo-de-checkout