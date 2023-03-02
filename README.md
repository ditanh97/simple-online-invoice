# Simple online invoice simulation

## Brief Summary
Simple online invoice simulation is application for mocking online invoice where users are divided as "Client" and "Admin". "Admin" initially generate invoice for 1 specific Client where they also include some item for billing. In order to show the list of item, 'Admin' must select the Client beforehand because Item is associated with the Client. Master data of item are inputed by the Admin and saved in the `m_item` table. Once, the invoice is created, the Invoice data is saved in `tt_invoices` table and the detail of item in invoice is saved in `tt_invoice_item` table. Also the log history of invoice is saved in `log_invoices`.



## Assumption

- `type` in `m_items` is considered to be only 'Service' and 'Goods'
- For simplicity, `invoice_id` is generate auto incrementally as the data addition in `tt_invoices`
  Ideally, the element of invoice number is formed like this `INV-YYYY-MM-XXXX`:
    - YYYY: years of invoice being created
    - MM: month of invoice being created
    - XXXX: 4 numbers of invoice made in that year and month
  for example: INV-2023-03-0001  => the fist invoice in 2023 March


## Test
- dump `invoiceapp_design_update.sql`
- adjust setting for database in .env
- run `php artisan serve`


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
