document.writeln("<OBJECT id=KisPosAgent  style=(LEFT: 0px; WIDTH: 0px; TOP: 0px; HEIGHT: 0px height=0 width=0 classid=clsid:74091A7F-FD8C-4440-96A2-CB2EB8BAD896></OBJECT>");
document.writeln("<script language=javascript for=KisPosAgent event=OnApprovalEnd()> KisPosAgent_OnApprovalEnd() </script>");

var outRtn, outReplyCode, outReplyMsg1, outReplyMsg2;
var outCreditCardNo, outAuthNo, outAuthDate, outFICode, outFIName, outIssuerCode, outIssuerName, outMemberNo, outTranNo,outTradeNum, outTradeReqTime, outTradeReqDate;


function KisPosAgent_OnApprovalEnd()
{
	GetData();
	
	//html내의 함수 실행.
	EventChk();	
}

function checkPlugin()
{
	if(navigator.appName == 'Netscape')
	{
		if(KisPosAgent == null)
		{
			alert("KisPosAgent.ocx가 설치되지 않았습니다.");
		}
		else
		{
			alert("KisPosAgent.ocx가 정상적으로 설치되었습니다.");
		}
	}
	else
	{
		if(KisPosAgent.object == null)
		{
			alert("KisPosAgent.ocx가 설치되지 않았습니다.");
		}
		else
		{
			alert("KisPosAgent.ocx가 정상적으로 설치되었습니다.");
		}
	}
}

function TransData_Event(agentIP, agentPORT, agentTranCode)
{
	KisPosAgent.inAgentIP = agentIP;
	KisPosAgent.inAgentPort = agentPORT;
	KisPosAgent.inTranCode = agentTranCode;
	
	KisPosAgent.Kis_Approval_Event();
}

function TransData(agentIP, agentPORT, agentTranCode)
{
	KisPosAgent.inAgentIP = agentIP;
	KisPosAgent.inAgentPort = agentPORT;
	KisPosAgent.inTranCode = agentTranCode;
	
	KisPosAgent.Kis_Approval();
}

function GetData()
{
	outRtn = KisPosAgent.outRtn;
	outReplyCode = KisPosAgent.outReplyCode;
	outReplyMsg1 = KisPosAgent.outReplyMsg1;
	outReplyMsg2 = KisPosAgent.outReplyMsg2;
	
	if(outRtn == "0" && outReplyCode == "0000")
	{
		outCreditCardNo = KisPosAgent.outCardNo;
		outAuthNo = KisPosAgent.outAuthNo;
		outAuthDate = KisPosAgent.outReplyDate;
		outFICode = KisPosAgent.outAccepterCode;
		outFIName = KisPosAgent.outAccepterName;
		outIssuerCode = KisPosAgent.outIssuerCode;
		outIssuerName = KisPosAgent.outIssuerName;
		outMemberNo = KisPosAgent.outMerchantRegNo;
		outTranNo = KisPosAgent.outTranNo;
		outTradeNum = KisPosAgent.outTradeNum;
		outTradeReqTime = KisPosAgent.outTradeReqTime;
		outTradeReqDate = KisPosAgent.outTradeReqDate;
	}
	else
	{
		outCreditCardNo = "";
		outAuthNo = "";
		outAuthDate = "";
		outFICode = "";
		outFIName = "";
		outIssuerCode = "";
		outIssuerName = "";
		outMemberNo = "";
		outTranNo = "";
		outTradeNum = "";
		outTradeReqTime = "";
		outTradeReqDate = "";
	}
	
	KisPosAgent.init();
}

function SetData(agentTranAmt, agentVatAmt, agentSvcAmt, agentInstallment, agentOrgAuthDate, agentOrgAuthNo)
{
	//console.log(KisPosAgent);
	KisPosAgent.init();
	KisPosAgent.inSignYN = "Y";
	KisPosAgent.inSignFileName = "";
	
	KisPosAgent.inTranAmt = agentTranAmt;
	KisPosAgent.inVatAmt = agentVatAmt;
	KisPosAgent.inSvcAmt = agentSvcAmt;
	
	KisPosAgent.inInstallment = agentInstallment;
	
	KisPosAgent.inOrgAuthDate = agentOrgAuthDate;
	KisPosAgent.inOrgAuthNo = agentOrgAuthNo;
}