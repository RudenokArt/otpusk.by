////////////////////////////////////////////////////////////////////////////////////////
// IfElseActivity
////////////////////////////////////////////////////////////////////////////////////////

IfElseActivity = function()
{
	var ob = new ParallelActivity();
	ob.Type = 'IfElseActivity';
	ob.childActivities = [];
	ob.__parallelActivityInitType = 'IfElseBranchActivity';

	return ob;
}
