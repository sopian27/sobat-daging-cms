<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'client/LandingPage';
$route['login-auth'] = 'client/Login';
$route['login-client'] = 'client/Login/verifyUserData';
$route['logout'] = 'client/Login/logout';
$route['home'] = 'auth/Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* petty-cash-in */
$route['petty-cash'] = 'auth/PettyCash';
$route['petty-in-save'] = 'auth/PettyCash/pettyInSave';

/* petty-cash-out */
$route['petty-cash-out'] = 'auth/PettyCashOut';
$route['petty-out-save'] = 'auth/PettyCashOut/pettyOutSave';

/* history-petty-cash */
$route['history-petty-cash'] = 'auth/HistoryPettyCash';
$route['history-petty-cash/getdata'] = 'auth/HistoryPettyCash/getData';
$route['history-petty-cash/loaddata'] = 'auth/HistoryPettyCash/loadData';
$route['history-petty-cash/getdatahistory'] = 'auth/HistoryPettyCash/getDataHistory';

/* expenses */
$route['expenses'] = 'auth/OperationalExpenses';
$route['expenses/exsave'] = 'auth/OperationalExpenses/exSave';

/* sallary */
$route['sallary'] = 'auth/Sallary';
$route['sallary/save'] = 'auth/Sallary/sallarySave';
$route['sallary-print'] = 'auth/Sallary/printData';

/* history-expenses */
$route['history-expenses'] = 'auth/HistoryExpenses';
$route['history-expenses/getdata'] = 'auth/HistoryExpenses/getData';

/* other-income */
$route['other'] = 'auth/OtherIncome';
$route['other/save'] = 'auth/OtherIncome/otherSave';

/* history-other-income */
$route['history-other'] = 'auth/HistoryOtherIncome';
$route['history-other/getdata'] = 'auth/HistoryOtherIncome/getData';

/* payment */
$route['payment'] = 'auth/Payment';
$route['paymentin-save'] = 'auth/Payment/paymentInSave';
$route['paymentin/getinvoice'] = 'auth/Payment/getInvoiceData';
$route['paymentin/loadhistory'] = 'auth/Payment/loadHistoryPayment';

/* payment-out */
$route['payment-out'] = 'auth/PaymentOut';
$route['paymentout-save'] = 'auth/PaymentOut/paymentOutSave';
$route['paymentout/getinvoice'] = 'auth/PaymentOut/getInvoiceData';
$route['paymentout/loadhistory'] = 'auth/PaymentOut/loadHistoryPayment';

/* payment-invoice customer */
$route['payment-invoice'] = 'auth/PaymentInvoice';
$route['payment-invoice/getnosuratjalan'] = 'auth/PaymentInvoice/getNoSuratJalan';
$route['payment-invoice-customer/save'] = 'auth/PaymentInvoice/trxNoSuratJalanSave';
$route['payment-invoice-customer-print'] = 'auth/PaymentInvoice/printData';
$route['payment-invoice-customer-print-preview'] = 'auth/PaymentInvoice/printPreview';

/* payment-invoice pembelian */
$route['payment-invoice-pembelian/getkodepo'] = 'auth/PaymentInvoice/getKodePo';
$route['payment-invoice-pembelian/save'] = 'auth/PaymentInvoice/trxKodePoSave';

/* history-payment */
$route['payment-history/gethistory'] = 'auth/PaymentHistory/getHistoryPayment';
$route['payment-history'] = 'auth/PaymentHistory';
$route['payment-history/gethistorysuratjalan'] = 'auth/PaymentInvoice/getNoSuratJalanHistory';
$route['payment-history/gethistorykodepo'] = 'auth/PaymentInvoice/getKodePoHistory';

/* return-cancel */
$route['return-cancel'] = 'auth/ReturnCancel';
$route['return-cancel/getinvoice'] = 'auth/ReturnCancel/getInvoiceData';
$route['return-cancel/save'] = 'auth/ReturnCancel/saveData';

/* return-history */
$route['return-history'] = 'auth/ReturnHistory';
$route['return-history/getdatabydate'] = 'auth/ReturnHistory/getDataByDate';
$route['return-history/getdatabydatehistory'] = 'auth/ReturnHistory/getDataByDateHistory';

/* ap */
$route['ap'] = 'auth/Ap';
$route['ap/getdatabydate'] = 'auth/Ap/getDataByDate';

/* ar */
$route['ar'] = 'auth/Ar';
$route['ar/getdatabydate'] = 'auth/Ar/getDataByDate';

/* crm */
$route['crm'] = 'auth/Crm';
$route['crm/search'] = 'auth/Crm/searchData';
$route['crm/getdata'] = 'auth/Crm/getData';

/* total-stock */
$route['total-stock'] = 'auth/TotalStock';
$route['total-stock/search'] = 'auth/TotalStock/searchData';
$route['total-stock/getdata'] = 'auth/TotalStock/getData';

/* data-mutasi */
$route['data-mutasi'] = 'auth/DataMutasi';

/* order-received */
$route['order-received'] = 'auth/OrderReceived';
$route['order-received/save'] = 'auth/OrderReceived/orderSave';
$route['order-received/getdatakode'] = 'auth/OrderReceived/getDataKode';
$route['order-received/getdatapelanggan'] = 'auth/OrderReceived/getDataPelanggan';

/*barang */
$route['barang/get-pagination-page'] = 'auth/Barang/GetPaginationPage';

/* live-order */
$route['live-order'] = 'auth/LiveOrder';
$route['live-order/getdatabydate'] = 'auth/LiveOrder/getDataByDate';
$route['live-order/confirmorder'] = 'auth/LiveOrder/confirmOrder';
$route['live-order/live-order-detail'] = 'auth/LiveOrder/liveOrderDetail';
$route['live-order/get-detail-trx'] = 'auth/LiveOrder/getDetailTrx';
$route['live-order/live-order-detailtrx/(:any)'] = 'auth/LiveOrder/liveOrderDetailTrx/$1';

/* history-order */
$route['history-order'] = 'auth/HistoryOrder';
$route['history-order/detailorder/(:any)'] = 'auth/HistoryOrder/detailOrder/$1';
$route['history-order/print-detail/(:any)'] = 'auth/HistoryOrder/printDetail/$1';
$route['history-order/getdatabydate'] = 'auth/HistoryOrder/getDataByDate';

/* inventory */
$route['inventory'] = 'auth/Inventory';
$route['inventory/save'] = 'auth/Inventory/inventorySaveInvMenu';

/* inventory-update */
$route['inventory-updatepo'] = 'auth/Inventory/updatepo';
$route['inventory/update'] = 'auth/inventory/inventoryUpdateInvMenu';
$route['inventory/delete'] = 'auth/inventory/inventoryDeleteInvMenu';
$route['inventory/unsetpostdata/(:any)'] = 'auth/inventory/UnsetPOSTData/$1';

/* inventory-live stock */
$route['inventory-livestock'] = 'auth/Inventory/livestock';
$route['inventory/update-data-livestock'] = 'auth/inventory/inventoryLiveStocksInvMenu';
$route['inventory/get-data-livestock-trx'] = 'auth/inventory/getDataLiveStocksByTRX';

/* inventory-mutasibarang*/
$route['inventory-mutasibarang'] = 'auth/Inventory/mutasibarang';

/* inventory-history*/
$route['inventory-historypo'] = 'auth/Inventory/historypo';

/* update-stock-pst*/
$route['inventory-updatestockpts'] = 'auth/Inventory/updatestockpts';
$route['inventory/save-pst'] = 'auth/inventory/inventorySavePSTMenu';





