<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AccountsController extends Controller
{
    public function index()
    {
    }

    public function saveAccounts($customerId, $accounts)
    {
        $date = Carbon::now();
        try {
            
            foreach ($accounts as $account) {
                DB::connection()->getPdo();
                if(!DB::table('accounts')->where('id', intval($account['id']))->exists()) {
                    if(!empty($account['type']) && $account['type']=="checking") {
                        $balanceDate = !empty($account['balanceDate']) ? date('Y-m-d H:i:s', $account['balanceDate']) : null;
                        $aggregationSuccessDate = !empty($account['aggregationSuccessDate']) ? date('Y-m-d H:i:s', $account['aggregationSuccessDate']) : null;
                        $aggregationAttemptDate = !empty($account['aggregationAttemptDate']) ? date('Y-m-d H:i:s', $account['aggregationAttemptDate']) : null;
                        $createdDate = !empty($account['createdDate']) ? date('Y-m-d H:i:s', $account['createdDate']) : null;
                        $lastUpdatedDate = !empty($account['lastUpdatedDate']) ? date('Y-m-d H:i:s', $account['lastUpdatedDate']) : null;
                        $lastTransactionDate = !empty($account['lastTransactionDate']) ? date('Y-m-d H:i:s', $account['lastTransactionDate']) : null;
                        $oldestTransactionDate = !empty($account['oldestTransactionDate']) ? date('Y-m-d H:i:s', $account['oldestTransactionDate']) : null;
                        $loanNextPaymentDate = date('Y-m-d H:i:s', !empty($account['loanNextPaymentDate']) ? $account['loanNextPaymentDate'] : null);
                        $loanMinAmtDueDate = date('Y-m-d H:i:s', !empty($account['loanMinAmtDueDate']) ? $account['loanMinAmtDueDate'] : null);
                        $firstPaymentDate = date('Y-m-d H:i:s', !empty($account['firstPaymentDate']) ? $account['firstPaymentDate'] : null);
                        $currentPriceDate = !empty($account['currentPriceDate']) ? date('Y-m-d H:i:s', $account['currentPriceDate']) : null;
                        $expirationDate = !empty($account['expirationDate']) ? date('Y-m-d H:i:s', $account['expirationDate']) : null;
                        $originalPurchaseDate = !empty($account['originalPurchaseDate']) ? date('Y-m-d H:i:s', $account['originalPurchaseDate']) : null;
                        DB::table('accounts')->insert([
                            'id' => intval($account['id']),
                            'number' => intval($account['number']),
                            'customerId' => intval($account['customerId']),
                            'type' => !empty($account['type']) ? $account['type'] : '',
                            'accountNumberDisplay' => !empty($account['accountNumberDisplay']) ? $account['accountNumberDisplay'] : '',
                            'name' => !empty($account['name']) ? $account['name'] : '',
                            'aggregationStatusCode' => !empty($account['aggregationStatusCode']) ? intval($account['aggregationStatusCode']) : 0,
                            'status' => !empty($account['status']) ? $account['status'] : '',
                            'institutionId' => !empty($account['institutionId']) ? $account['institutionId'] : '',
                            'currency' => !empty($account['currency']) ? $account['currency'] : '',
                            'institutionLoginId' => !empty($account['institutionLoginId']) ? $account['institutionLoginId'] : '',
                            'displayPosition' => !empty($account['displayPosition']) ? $account['displayPosition'] : '',
                            'financialinstitutionAccountStatus' => !empty($account['financialinstitutionAccountStatus']) ? $account['financialinstitutionAccountStatus'] : '',
                            'accountNickname' => !empty($account['accountNickname']) ? $account['accountNickname'] : '',
                            'detail' => !empty($account['detail']) ? json_encode($account['detail']) : '',
                            'position' => !empty($account['position']) ? json_encode($account['position']) : '',
                            'balance' => !empty($account['balance']) ? $account['balance'] : 0,
                            'currentBalance' => !empty($account['currentBalance']) ? $account['currentBalance'] : 0,
                            'balanceDate' => $balanceDate,
                            'aggregationSuccessDate' => $aggregationSuccessDate,
                            'aggregationAttemptDate' => $aggregationAttemptDate,
                            'createdDate' => $createdDate,
                            'lastUpdatedDate' => $lastUpdatedDate,
                            'lastTransactionDate' => $lastTransactionDate,
                            'oldestTransactionDate' => $oldestTransactionDate,

                            'vestedBalance' => !empty($account['detail']['vestedBalance']) ? $account['detail']['vestedBalance'] : 0,
                            'currentLoanBalance' => !empty($account['detail']['currentLoanBalance']) ? $account['detail']['currentLoanBalance'] : 0,
                            'interestMarginBalance' => !empty($account['detail']['interestMarginBalance']) ? $account['detail']['interestMarginBalance'] : 0,
                            'availableCashBalance' => !empty($account['detail']['availableCashBalance']) ? $account['detail']['availableCashBalance'] : 0,
                            'availableBalanceAmount' => !empty($account['detail']['availableBalanceAmount']) ? $account['detail']['availableBalanceAmount'] : 0,
                            'loanRate' => !empty($account['detail']['loanRate']) ? $account['detail']['loanRate'] : 0,
                            'employeeDeferPreTaxAmount' => !empty($account['detail']['employeeDeferPreTaxAmount']) ? $account['detail']['employeeDeferPreTaxAmount'] : 0,
                            'employeePreTaxAmount' => !empty($account['detail']['employeePreTaxAmount']) ? $account['detail']['employeePreTaxAmount'] : 0,
                            'employeePreTaxPercentage' => !empty($account['detail']['employeePreTaxPercentage']) ? $account['detail']['employeePreTaxPercentage'] : 0,
                            'employerYearToDate' => !empty($account['detail']['employerYearToDate']) ? $account['detail']['employerYearToDate'] : 0,
                            'rolloverContributionAmount' => !empty($account['detail']['rolloverContributionAmount']) ? $account['detail']['rolloverContributionAmount'] : 0,
                            'allowedCheckWriting' => !empty($account['detail']['allowedCheckWriting']) ? $account['detail']['allowedCheckWriting'] : '',
                            'allowedOptionTrade' => !empty($account['detail']['allowedOptionTrade']) ? $account['detail']['allowedOptionTrade'] : '',
                            'dailyChange' => !empty($account['detail']['dailyChange']) ? $account['detail']['dailyChange'] : 0,
                            'margin' => !empty($account['detail']['margin']) ? $account['detail']['margin'] : 0,
                            'percentageChange' => !empty($account['detail']['percentageChange']) ? $account['detail']['percentageChange'] : 0,
                            'loanPaymentAmount' => !empty($account['detail']['loanPaymentAmount']) ? $account['detail']['loanPaymentAmount'] : 0,
                            'loanNextPaymentDate' => $loanNextPaymentDate,
                            'payoffAmount' => !empty($account['detail']['payoffAmount']) ? $account['detail']['payoffAmount'] : 0,
                            'principalBalance' => !empty($account['detail']['principalBalance']) ? $account['detail']['principalBalance'] : 0,
                            'escrowBalance' => !empty($account['detail']['escrowBalance']) ? $account['detail']['escrowBalance'] : 0,
                            'interestRate' => !empty($account['detail']['interestRate']) ? $account['detail']['interestRate'] : '',
                            'autoPayEnrolled' => !empty($account['detail']['autoPayEnrolled']) ? $account['detail']['autoPayEnrolled'] : '',
                            'collateral' => !empty($account['detail']['collateral']) ? $account['detail']['collateral'] : '',
                            'currentSchool' => !empty($account['detail']['currentSchool']) ? $account['detail']['currentSchool'] : '',
                            'firstMortgage' => !empty($account['detail']['firstMortgage']) ? $account['detail']['firstMortgage'] : '',
                            'originalSchool' => !empty($account['detail']['originalSchool']) ? $account['detail']['originalSchool'] : '',
                            'recurringPaymentAmount' => !empty($account['detail']['recurringPaymentAmount']) ? $account['detail']['recurringPaymentAmount'] : 0,
                            'lender' => !empty($account['detail']['lender']) ? $account['detail']['lender'] : '',
                            'endingBalanceAmount' => !empty($account['detail']['endingBalanceAmount']) ? $account['detail']['endingBalanceAmount'] : 0,
                            'loanTermType' => !empty($account['detail']['loanTermType']) ? $account['detail']['loanTermType'] : '',
                            'paymentsMade' => !empty($account['detail']['paymentsMade']) ? $account['detail']['paymentsMade'] : 0,
                            'balloonAmount' => !empty($account['detail']['balloonAmount']) ? $account['detail']['balloonAmount'] : 0,
                            'projectedInterest' => !empty($account['detail']['projectedInterest']) ? $account['detail']['projectedInterest'] : 0,
                            'interestPaidLtd' => !empty($account['detail']['interestPaidLtd']) ? $account['detail']['interestPaidLtd'] : 0,
                            'interestRateType' => !empty($account['detail']['interestRateType']) ? $account['detail']['interestRateType'] : '',
                            'loanPaymentType' => !empty($account['detail']['loanPaymentType']) ? $account['detail']['loanPaymentType'] : '',
                            'paymentsRemaining' => !empty($account['detail']['paymentsRemaining']) ? $account['detail']['paymentsRemaining'] : 0,
                            'loanMinAmtDue' => !empty($account['detail']['loanMinAmtDue']) ? $account['detail']['loanMinAmtDue'] : 0,
                            'loanPaymentFreq' => !empty($account['detail']['loanPaymentFreq']) ? $account['detail']['loanPaymentFreq'] : '',
                            'paymentMinAmount' => !empty($account['detail']['paymentMinAmount']) ? $account['detail']['paymentMinAmount'] : 0,
                            'loanMinAmtDueDate' => $loanMinAmtDueDate,
                            'firstPaymentDate' => $firstPaymentDate,

                            'positionId' => !empty($account['position'][0]['positionId']) ? intval($account['position'][0]['positionId']) : 0,
                            'description' => !empty($account['position'][0]['description']) ? $account['position'][0]['description'] : '',
                            'cusipNo' => !empty($account['position'][0]['cusipNo']) ? $account['position'][0]['cusipNo'] : '',
                            'symbol' => !empty($account['position'][0]['symbol']) ? $account['position'][0]['symbol'] : '',
                            'quantity' => !empty($account['position'][0]['quantity']) ? $account['position'][0]['quantity'] : 0,
                            'currentPrice' => !empty($account['position'][0]['currentPrice']) ? $account['position'][0]['currentPrice'] : 0,
                            'marketValue' => !empty($account['position'][0]['marketValue']) ? $account['position'][0]['marketValue'] : '',
                            'changePercent' => !empty($account['position'][0]['changePercent']) ? $account['position'][0]['changePercent'] : 0,
                            'costBasis' => !empty($account['position'][0]['costBasis']) ? $account['position'][0]['costBasis'] : 0,
                            'dailyChangePosition' => !empty($account['position'][0]['dailyChangePosition']) ? $account['position'][0]['dailyChangePosition'] : 0,
                            'memo' => !empty($account['position'][0]['memo']) ? $account['position'][0]['memo'] : '',
                            'fundName' => !empty($account['position'][0]['fundName']) ? $account['position'][0]['fundName'] : '',
                            'securityName' => !empty($account['position'][0]['securityName']) ? $account['position'][0]['securityName'] : '',
                            'transactionType' => !empty($account['position'][0]['transactionType']) ? $account['position'][0]['transactionType'] : '',
                            'empPretaxContribAmount' => !empty($account['position'][0]['empPretaxContribAmount']) ? $account['position'][0]['empPretaxContribAmount'] : 0,
                            'heldInAccount' => !empty($account['position'][0]['heldInAccount']) ? $account['position'][0]['heldInAccount'] : '',
                            'holdType' => !empty($account['position'][0]['holdType']) ? $account['position'][0]['holdType'] : '',
                            'maturityValue' => !empty($account['position'][0]['maturityValue']) ? $account['position'][0]['maturityValue'] : 0,
                            'units' => !empty($account['position'][0]['units']) ? $account['position'][0]['units'] : 0,
                            'unitPrice' => !empty($account['position'][0]['unitPrice']) ? $account['position'][0]['unitPrice'] : 0,
                            'typePosition' => !empty($account['position'][0]['typePosition']) ? $account['position'][0]['typePosition'] : '',
                            'statusPosition' => !empty($account['position'][0]['statusPosition']) ? $account['position'][0]['statusPosition'] : '',
                            'invSecurityType' => !empty($account['position'][0]['invSecurityType']) ? $account['position'][0]['invSecurityType'] : '',
                            'securityCurrencyRate' => !empty($account['position'][0]['securityCurrencyRate']) ? $account['position'][0]['securityCurrencyRate'] : '',
                            'averageCost' => !empty($account['position'][0]['averageCost']) ? $account['position'][0]['averageCost'] : 0,
                            'cashAccount' => !empty($account['position'][0]['cashAccount']) ? $account['position'][0]['cashAccount'] : 0,
                            'faceValue' => !empty($account['position'][0]['faceValue']) ? $account['position'][0]['faceValue'] : 0,
                            'holdingId' => !empty($account['position'][0]['holdingId']) ? $account['position'][0]['holdingId'] : '',
                            'securitySubType' => !empty($account['position'][0]['securitySubType']) ? $account['position'][0]['securitySubType'] : '',
                            'rate' => !empty($account['position'][0]['rate']) ? $account['position'][0]['rate'] : 0,
                            'unitType' => !empty($account['position'][0]['unitType']) ? $account['position'][0]['unitType'] : '',
                            'todayGLDollar' => !empty($account['position'][0]['todayGLDollar']) ? $account['position'][0]['todayGLDollar'] : 0,
                            'todayGLPercent' => !empty($account['position'][0]['todayGLPercent']) ? $account['position'][0]['todayGLPercent'] : 0,
                            'totalGLDollar' => !empty($account['position'][0]['totalGLDollar']) ? $account['position'][0]['totalGLDollar'] : 0,
                            'totalGLPercent' => !empty($account['position'][0]['totalGLPercent']) ? $account['position'][0]['totalGLPercent'] : 0,
                            'costBasisPerShare' => !empty($account['position'][0]['costBasisPerShare']) ? $account['position'][0]['costBasisPerShare'] : 0,
                            'enterpriseSymbol' => !empty($account['position'][0]['enterpriseSymbol']) ? $account['position'][0]['enterpriseSymbol'] : '',
                            'localMarketValue' => !empty($account['position'][0]['localMarketValue']) ? $account['position'][0]['localMarketValue'] : 0,
                            'localPrice' => !empty($account['position'][0]['localPrice']) ? $account['position'][0]['localPrice'] : 0,
                            'securityId' => !empty($account['position'][0]['securityId']) ? $account['position'][0]['securityId'] : 0,
                            'reinvestmentCapGains' => !empty($account['position'][0]['reinvestmentCapGains']) ? $account['position'][0]['reinvestmentCapGains'] : '',
                            'reinvestmentDividend' => !empty($account['position'][0]['reinvestmentDividend']) ? $account['position'][0]['reinvestmentDividend'] : '',
                            'currentPriceDate' => $currentPriceDate,
                            'expirationDate' => $expirationDate,
                            'originalPurchaseDate' => $originalPurchaseDate,

                            'created_at' => $date
                        ]);
                    }
                }

                //$this->getAccountOwner($customerId, $account['id']);
                //$this->generateCashFlowReport($customerId, $account['id']);
            } 
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }     

    public function saveAccountOwner($owner)
    {
        $date = Carbon::now();
        try {
            DB::connection()->getPdo();
            $asOfDate = !empty($owner['asOfDate']) ? date('Y-m-d H:i:s', $owner['asOfDate']) : null;
            DB::table('account_owner')->insert([
                'customer_id' => intval($owner['customerId']),
                'account_id' => intval($owner['accountId']),
                'owner_name' => !empty($owner['ownerName']) ? $owner['ownerName'] : '',
                'owner_address' => !empty($owner['ownerAddress']) ? intval(substr($owner['ownerAddress'],0,18)) : 0,
                'as_of_date' => $asOfDate,
                'created_at' => $date
            ]); 
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database. Please check your configuration. error:" . $e );
        }
    }

    public function getDataAccounts()
    {
        try {
            DB::connection()->getPdo();
            $accounts = DB::table('accounts')->get();
            return view('accounts.getdatacustomerlogs', compact('accounts'));
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }

}
