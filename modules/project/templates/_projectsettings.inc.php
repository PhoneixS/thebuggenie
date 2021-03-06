<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
<form accept-charset="<?php echo TBGContext::getI18n()->getCharset(); ?>" action="<?php echo make_url('configure_project_settings', array('project_id' => $project->getID())); ?>" method="post" onsubmit="TBG.Project.submitAdvancedSettings('<?php echo make_url('configure_project_settings', array('project_id' => $project->getID())); ?>'); return false;" id="project_settings">
<?php endif; ?>
	<h3><?php echo __('Editing advanced project settings'); ?></h3>
	<h4><?php echo __('Project-specific settings'); ?>
	<table style="clear: both; width: 780px;" class="padded_table" cellpadding=0 cellspacing=0>
		<tr>
			<td><label for="released"><?php echo __('Released'); ?></label></td>
			<td>
				<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
					<select name="released" id="released" style="width: 70px;">
						<option value=1<?php if ($project->isReleased()): ?> selected<?php endif; ?>><?php echo __('Yes'); ?></option>
						<option value=0<?php if (!$project->isReleased()): ?> selected<?php endif; ?>><?php echo __('No'); ?></option>
					</select>
				<?php else: ?>
					<?php echo ($project->isReleased()) ? __('Yes') : __('No'); ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td><label for="has_release_date"><?php echo __('Release date'); ?></label></td>
			<td style="padding: 2px;">
				<select name="has_release_date" id="has_release_date" style="width: 70px;" onchange="var val = $(this).getValue(); ['day', 'month', 'year'].each(function(item) { (val) ? $('release_'+item).enable() : $('release_'+item).disable(); });">
					<option value=1<?php if ($project->hasReleaseDate()): ?> selected<?php endif; ?>><?php echo __('Yes'); ?></option>
					<option value=0<?php if (!$project->hasReleaseDate()): ?> selected<?php endif; ?>><?php echo __('No'); ?></option>
				</select>
				<select style="width: 85px;" name="release_month" id="release_month"<?php if (!$project->hasReleaseDate()): ?> disabled<?php endif; ?>>
				<?php for($cc = 1;$cc <= 12;$cc++): ?>
					<option value=<?php print $cc; ?><?php print (($project->getReleaseDateMonth() == $cc) ? " selected" : "") ?>><?php echo strftime('%B', mktime(0, 0, 0, $cc, 1)); ?></option>
				<?php endfor; ?>
				</select>
				<select style="width: 40px;" name="release_day" id="release_day"<?php if (!$project->hasReleaseDate()): ?> disabled<?php endif; ?>>
				<?php for($cc = 1;$cc <= 31;$cc++): ?>
					<option value=<?php print $cc; ?><?php echo (($project->getReleaseDateDay() == $cc) ? " selected" : "") ?>><?php echo $cc; ?></option>
				<?php endfor; ?>
				</select>
				<select style="width: 55px;" name="release_year" id="release_year"<?php if (!$project->hasReleaseDate()): ?> disabled<?php endif; ?>>
				<?php for($cc = 1990;$cc <= (date("Y") + 10);$cc++): ?>
					<option value=<?php print $cc; ?><?php echo (($project->getReleaseDateYear() == $cc) ? " selected" : "") ?>><?php echo $cc; ?></option>
				<?php endfor; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="enable_builds"><?php echo __('Enable releases'); ?></label></td>
			<td>
				<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
					<select name="enable_builds" id="enable_builds" style="width: 70px;">
						<option value=1<?php if ($project->isBuildsEnabled()): ?> selected<?php endif; ?>><?php echo __('Yes'); ?></option>
						<option value=0<?php if (!$project->isBuildsEnabled()): ?> selected<?php endif; ?>><?php echo __('No'); ?></option>
					</select>
				<?php else: ?>
					<?php echo ($project->isBuildsEnabled()) ? __('Yes') : __('No'); ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="config_explanation" colspan="2"><?php echo __('If this project has regular new main- or test-releases, you should enable releases'); ?></td>
		</tr>
		<tr>
			<td><label for="enable_editions"><?php echo __('Use editions'); ?></label></td>
			<td>
				<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
					<select name="enable_editions" id="enable_editions" style="width: 70px;">
						<option value=1<?php if ($project->isEditionsEnabled()): ?> selected<?php endif; ?>><?php echo __('Yes'); ?></option>
						<option value=0<?php if (!$project->isEditionsEnabled()): ?> selected<?php endif; ?>><?php echo __('No'); ?></option>
					</select>
				<?php else: ?>
					<?php echo ($project->isEditionsEnabled()) ? __('Yes') : __('No'); ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="config_explanation" colspan="2"><?php echo __('If the project has more than one edition which differ in features or capabilities, you should enable editions'); ?></td>
		</tr>
		<tr>
			<td><label for="enable_components"><?php echo __('Use components'); ?></label></td>
			<td>
				<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
					<select name="enable_components" id="enable_components" style="width: 70px;">
						<option value=1<?php if ($project->isComponentsEnabled()): ?> selected<?php endif; ?>><?php echo __('Yes'); ?></option>
						<option value=0<?php if (!$project->isComponentsEnabled()): ?> selected<?php endif; ?>><?php echo __('No'); ?></option>
					</select>
				<?php else: ?>
					<?php echo ($project->isComponentsEnabled()) ? __('Yes') : __('No'); ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="config_explanation" colspan="2" style="padding-bottom: 10px;"><?php echo __('If the project consists of several easily identifiable sub-parts, you should enable components'); ?></td>
		</tr>
	</table>
	<h4><?php echo __('Settings related to issues and issue reporting'); ?></h4>
	<table style="clear: both; width: 780px;" class="padded_table" cellpadding=0 cellspacing=0>
		<tr>
			<td><label for="workflow_scheme"><?php echo __('Workflow scheme'); ?></label></td>
			<td style="padding: 5px;">
				<?php echo $project->getWorkflowScheme()->getName(); ?>
				<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
				<div class="button button-blue" style="float: right; margin-top: -10px;" onclick="TBG.Main.Helpers.Backdrop.show('<?php echo make_url('get_partial_for_backdrop', array('key' => 'project_workflow', 'project_id' => $project->getId())); ?>');"><span><?php echo __('Change workflow scheme'); ?></span></div>
					<?php /*<select name="workflow_scheme" id="workflow_scheme">
						<?php foreach (TBGWorkflowScheme::getAll() as $workflow_scheme): ?>
							<option value=<?php echo $workflow_scheme->getID(); ?><?php if ($project->getWorkflowScheme()->getID() == $workflow_scheme->getID()): ?> selected<?php endif; ?>><?php echo $workflow_scheme->getName(); ?></option>
						<?php endforeach; ?>
					</select> */ ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td style="width: 300px;"><label for="locked"><?php echo __('Allow issues to be reported'); ?></label></td>
			<td style="width: 580px;">
				<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
					<select name="locked" id="locked" style="width: 70px;">
						<option value=0<?php if (!$project->isLocked()): ?> selected<?php endif; ?>><?php echo __('Yes'); ?></option>
						<option value=1<?php if ($project->isLocked()): ?> selected<?php endif; ?>><?php echo __('No'); ?></option>
					</select>
				<?php else: ?>
					<?php echo (!$project->isLocked()) ? __('Yes') : __('No'); ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td><label for="issuetype_scheme"><?php echo __('Issuetype scheme'); ?></label></td>
			<td>
				<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
					<select name="issuetype_scheme" id="issuetype_scheme">
						<?php foreach (TBGIssuetypeScheme::getAll() as $issuetype_scheme): ?>
							<option value=<?php echo $issuetype_scheme->getID(); ?><?php if ($project->getIssuetypeScheme()->getID() == $issuetype_scheme->getID()): ?> selected<?php endif; ?>><?php echo $issuetype_scheme->getName(); ?></option>
						<?php endforeach; ?>
					</select>
				<?php else: ?>
					<?php echo $project->getIssuetypeScheme()->getName(); ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td><label for="allow_changing_without_working"><?php echo __('Allow freelancing'); ?></label></td>
			<td>
				<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
					<select name="allow_changing_without_working" id="allow_changing_without_working" style="width: 70px;">
						<option value=1<?php if ($project->canChangeIssuesWithoutWorkingOnThem()): ?> selected<?php endif; ?>><?php echo __('Yes'); ?></option>
						<option value=0<?php if (!$project->canChangeIssuesWithoutWorkingOnThem()): ?> selected<?php endif; ?>><?php echo __('No'); ?></option>
					</select>
				<?php else: ?>
					<?php echo ($project->canChangeIssuesWithoutWorkingOnThem()) ? __('Yes') : __('No'); ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="config_explanation" colspan="2"><?php echo __('Whether or not developers can change details on an issue without marking themselves as working on the issue'); ?></td>
		</tr>
		<tr>
			<td><label for="allow_autoassignment"><?php echo __('Enable autoassignment'); ?></label></td>
			<td>
				<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
					<select name="allow_autoassignment" id="allow_autoassignment" style="width: 70px;">
						<option value=1<?php if ($project->canAutoassign()): ?> selected<?php endif; ?>><?php echo __('Yes'); ?></option>
						<option value=0<?php if (!$project->canAutoassign()): ?> selected<?php endif; ?>><?php echo __('No'); ?></option>
					</select>
				<?php else: ?>
					<?php echo ($project->canAutoassign()) ? __('Yes') : __('No'); ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="config_explanation" colspan="2"><?php echo __('You can set issues to be automatically assigned to users depending on the leader set for editions, components and projects. If you wish to use this feature you can turn it on here.'); ?></td>
		</tr>
	<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
		<tr>
			<td colspan="2" style="padding: 10px 0 10px 10px; text-align: right;">
				<div style="float: left; font-size: 13px; padding-top: 2px; font-style: italic;" class="config_explanation"><?php echo __('When you are done, click "%save%" to save your changes', array('%save%' => __('Save'))); ?></div>
				<input class="button button-green" style="float: right;" type="submit" id="project_submit_settings_button" value="<?php echo __('Save'); ?>">
				<span id="project_settings_indicator" style="display: none; float: right;"><?php echo image_tag('spinning_20.gif'); ?></span>
			</td>
		</tr>
	<?php endif; ?>
	</table>
<?php if ($access_level == TBGSettings::ACCESS_FULL): ?>
</form>
<?php endif; ?>
