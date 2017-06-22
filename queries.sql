select g.groupId, g.accountNumber,
ifnull(
(select sum(t`.amount) 
	from transactions t where ((t.status = 'APPROVED') or ((t.status = 'COMPLETE') and (t.forGroupId = g.groupId) and (t.operation = 'CREDIT')))),
0) AS `Balance`
from groups g



SELECT G.groupId, G.accountNumber,
IFNULL((SELECT SUM(T.amount) FROM transactions T WHERE T.`status`='APPROVED' AND T.`forGroupId` = G.`groupId`),0) BALANCE
FROM groups G
