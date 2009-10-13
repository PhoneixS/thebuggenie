<?php

	/**
	 * Issue fields table
	 *
	 * @author Daniel Andre Eikeland <zegenie@zegeniestudios.net>
	 * @version 2.0
	 * @license http://www.opensource.org/licenses/mozilla1.1.php Mozilla Public License 1.1 (MPL 1.1)
	 * @package thebuggenie
	 * @subpackage tables
	 */

	/**
	 * Issue fields table
	 *
	 * @package thebuggenie
	 * @subpackage tables
	 */
	class B2tIssueFields extends B2DBTable 
	{

		const B2DBNAME = 'bugs2_issuefields';
		const ID = 'bugs2_issuefields.id';
		const SCOPE = 'bugs2_issuefields.scope';
		const PROJECT_ID = 'bugs2_issuefields.project_id';
		const CATEGORY_ID = 'bugs2_issuefields.category_id';
		const ADDITIONAL = 'bugs2_issuefields.is_additional';
		const ISSUETYPE_ID = 'bugs2_issuefields.issuetype_id';
		const FIELD_KEY = 'bugs2_issuefields.field_key';
		const REPORTABLE = 'bugs2_issuefields.is_reportable';
		const REQUIRED = 'bugs2_issuefields.required';

		public function __construct()
		{
			parent::__construct(self::B2DBNAME, self::ID);
			parent::_addVarchar(self::FIELD_KEY, 20);
			parent::_addBoolean(self::REQUIRED);
			parent::_addBoolean(self::REPORTABLE);
			parent::_addBoolean(self::ADDITIONAL);
			parent::_addForeignKeyColumn(self::PROJECT_ID, B2DB::getTable('B2tProjects'), B2tProjects::ID);
			parent::_addForeignKeyColumn(self::CATEGORY_ID, B2DB::getTable('B2tListTypes'), B2tListTypes::ID);
			parent::_addForeignKeyColumn(self::ISSUETYPE_ID, B2DB::getTable('B2tIssueTypes'), B2tIssueTypes::ID);
			parent::_addForeignKeyColumn(self::SCOPE, B2DB::getTable('B2tScopes'), B2tScopes::ID);
		}
		
		public function getByProjectIDandIssuetypeID($project_id, $issuetype_id)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::PROJECT_ID, $project_id);
			$crit->addWhere(self::ISSUETYPE_ID, $issuetype_id);
			$res = $this->doSelect($crit);
			return $res;
		}

		public function getByIssuetypeID($issuetype_id)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::PROJECT_ID, 0);
			$crit->addWhere(self::ISSUETYPE_ID, $issuetype_id);
			$res = $this->doSelect($crit);
			return $res;
		}

		public function loadFixtures($scope, $issue_type_bug_report_id, $issue_type_feature_request_id, $issue_type_enhancement_id, $issue_type_task_id, $issue_type_user_story_id)
		{
			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'description');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::REQUIRED, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'reproduction_steps');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::REQUIRED, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'edition');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::REQUIRED, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'build');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::REQUIRED, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'component');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'category');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'reproducability');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'resolution');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'severity');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'milestone');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'estimated_time');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'spent_time');
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'percentcomplete');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_bug_report_id);
			$crit->addInsert(self::FIELD_KEY, 'priority');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_feature_request_id);
			$crit->addInsert(self::FIELD_KEY, 'description');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::REQUIRED, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_feature_request_id);
			$crit->addInsert(self::FIELD_KEY, 'milestone');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_feature_request_id);
			$crit->addInsert(self::FIELD_KEY, 'category');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_feature_request_id);
			$crit->addInsert(self::FIELD_KEY, 'estimated_time');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_feature_request_id);
			$crit->addInsert(self::FIELD_KEY, 'spent_time');
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_feature_request_id);
			$crit->addInsert(self::FIELD_KEY, 'percent_complete');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_feature_request_id);
			$crit->addInsert(self::FIELD_KEY, 'priority');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_enhancement_id);
			$crit->addInsert(self::FIELD_KEY, 'description');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::REQUIRED, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_enhancement_id);
			$crit->addInsert(self::FIELD_KEY, 'milestone');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_enhancement_id);
			$crit->addInsert(self::FIELD_KEY, 'category');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_enhancement_id);
			$crit->addInsert(self::FIELD_KEY, 'estimated_time');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_enhancement_id);
			$crit->addInsert(self::FIELD_KEY, 'spent_time');
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_enhancement_id);
			$crit->addInsert(self::FIELD_KEY, 'percent_complete');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_enhancement_id);
			$crit->addInsert(self::FIELD_KEY, 'priority');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_task_id);
			$crit->addInsert(self::FIELD_KEY, 'description');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_task_id);
			$crit->addInsert(self::FIELD_KEY, 'category');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_task_id);
			$crit->addInsert(self::FIELD_KEY, 'estimated_time');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_task_id);
			$crit->addInsert(self::FIELD_KEY, 'spent_time');
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_task_id);
			$crit->addInsert(self::FIELD_KEY, 'percent_complete');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_task_id);
			$crit->addInsert(self::FIELD_KEY, 'priority');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::ADDITIONAL, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_user_story_id);
			$crit->addInsert(self::FIELD_KEY, 'description');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_user_story_id);
			$crit->addInsert(self::FIELD_KEY, 'percent_complete');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_user_story_id);
			$crit->addInsert(self::FIELD_KEY, 'category');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_user_story_id);
			$crit->addInsert(self::FIELD_KEY, 'milestone');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_user_story_id);
			$crit->addInsert(self::FIELD_KEY, 'estimated_time');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_user_story_id);
			$crit->addInsert(self::FIELD_KEY, 'spent_time');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);

			$crit = $this->getCriteria();
			$crit->addInsert(self::ISSUETYPE_ID, $issue_type_user_story_id);
			$crit->addInsert(self::FIELD_KEY, 'priority');
			$crit->addInsert(self::REPORTABLE, true);
			$crit->addInsert(self::SCOPE, $scope);
			$this->doInsert($crit);
		}
		
	}
