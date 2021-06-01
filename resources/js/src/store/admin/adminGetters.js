/*=========================================================================================
  File Name: moduleCalendarGetters.js
  Description: Calendar Module Getters
  ----------------------------------------------------------------------------------------


  Author URL: https://github.com/uyanik13
==========================================================================================*/


export default {

  chartDataForPayments: (state) =>  state.payments.flatMap(payment => payment['amount']),
  chartDataForLastWeekPayments: (state) =>  state.lastWeekPayments.flatMap(payment => payment['amount']),
  chartDataForLastMonthPayments: (state) =>  state.lastMonthPayments.flatMap(payment => payment['amount']),
  chartDataForLastMonthPaymentsDates: (state) =>  state.lastMonthPayments.flatMap(payment => payment['created_at']),
  chartDataForLastYearPayments: (state) =>  state.lastYearPayments.flatMap(payment => payment['amount']),
  chartDataForLastYearPaymentsDates: (state) =>  state.lastYearPayments.flatMap(payment => payment['created_at']),
  chartDataForThisMonthPayments: (state) =>  state.thisMonthPayments.flatMap(payment => payment['amount']),





  pendingPayments:(state) =>  state.payments.filter((payment) => payment.status === 'pending'),
  pendingPaymentsAmount:(state) => state.payments.filter((payment) => payment.status === 'pending').map(o => o.amount).reduce((a, c) => a + c, 0),
  completedPayments: (state) => state.payments.filter((token) => token.status === 'completed'),


  completedPaymentsCountries: (state) => state.payments.filter((token) => token.status === 'completed').flatMap(payment => payment['payment_country']),

  lastWeekPaymentsAmount: (state) => state.lastWeekPayments.filter((token) => token.status === 'completed').map(o => o.amount).reduce((a, c) => a + c, 0),
  lastMonthPaymentsAmount: (state) => state.lastMonthPayments.filter((token) => token.status === 'completed').map(o => o.amount).reduce((a, c) => a + c, 0),
  thisMonthPaymentsAmount: (state) => state.thisMonthPayments.filter((token) => token.status === 'completed').map(o => o.amount).reduce((a, c) => a + c, 0),
  lastYearPaymentsAmount: (state) => state.lastYearPayments.filter((token) => token.status === 'completed').map(o => o.amount).reduce((a, c) => a + c, 0),



  chartDataForOrders: (state) =>  state.orders.flatMap(payment => payment['price']),
  pendingOrders:(state) =>  state.orders.filter((payment) => payment.status === 'pending'),
  pendingOrdersAmount:(state) => state.orders.filter((payment) => payment.status === 'pending').map(o => o.price).reduce((a, c) => a + c, 0),
  completedOrders: (state) => state.orders.filter((token) => token.status === 'completed'),
  completedOrdersAmount: (state) => state.orders.filter((token) => token.status === 'completed').map(o => o.price).reduce((a, c) => a + c, 0),



}
