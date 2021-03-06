<?php

class QueryStorage {

    private $queries = array(
        'sport' =>
        array(
            'deleteProject' => 'delete from `w_sport_project` where `id` = {id};',
            'selectProjects' => 'select `id`, `name`, `url` from `w_sport_project` order by `id`;',
            'selectProjectById' => 'select `id`, `name`, `url` from `w_sport_project` where `id` = {id};',
            'selectProjectByName' => 'select `id` from `w_sport_project` where `name` = "{name}";',
            'insertProject' => 'insert into `w_sport_project`(`name`, `url`) values ("{name}", "{url}");',
            'updateProjectById' => 'update `w_sport_project` set `name` = "{name}", `url` = "{url}" where `id` = {id};',
            'deleteSeason' => 'delete from `w_sport_season` where `id` = {id};',
            'selectSeasonsByProjectId' => 'select `id`, `start_year`, `end_year` from `w_sport_season` where `project_id` = {projectId} order by `id`;',
            'selectSeasonById' => 'select `id`, `start_year`, `end_year` FROM `w_sport_season` where `id` = {id};',
            'updateSeasonById' => 'update `w_sport_season` set `start_year` = {startYear}, `end_year` = {endYear} where `id` = {id};',
            'insertSeason' => 'insert into `w_sport_season`(`start_year`, `end_year`, `project_id`) values ({startYear}, {endYear}, {projectId});',
            'selectTeamFromTableByTeamIdSeasonIdTableId' => 'select `matches`, `wins`, `draws`, `loses`, `s_score`, `r_score`, `points`, `table_id` from `w_sport_table` where `team` = {teamId} and `season` = {seasonId} and `table_id` = {tableId};',
            'selectMatchByIdSeasonId' => 'select `id`, `h_team`, `a_team`, `h_score`, `a_score`, `h_shoots`, `a_shoots`, `h_penalty`, `a_penalty`, `h_extratime`, `a_extratime`, `comment`, `round`, `in_table`, `season`, `notplayed`, `refs`, `refs2`, `place`, `date`, `time`, `main_stuff`, `stuff`, `stuff2` from `w_sport_match` where `id` = {id} AND `season` = {seasonId};',
            'updateTableByIdTeamIdSeasonId' => 'update `w_sport_table` set `matches` = {matches}, `wins` = {wins}, `draws` = {draws}, `loses` = {loses}, `s_score` = {sScore}, `r_score` = {rScore}, `points` = {points} where `team` = {teamId} AND `season` = {seasonId} AND `table_id` = {tableId};',
            'updateMatchById' => 'update `w_sport_match` set `h_team` = {hTeamId}, `a_team` = {aTeamId}, `h_score` = {hScore}, `a_score` = {aScore}, `h_shoots` = {hShoots}, `a_shoots` = {aShoots}, `h_penalty` = {hPenalty}, `a_penalty` = {aPenalty}, `h_extratime` = {hExtratime}, `a_extratime` = {aExtratime}, `comment` = "{comment}", `round` = {round}, `in_table` = {tableId}, `season` = {seasonId}, `date` = "{date}", `time` = "{time}", `refs` = "{refs1}", `refs2` = "{refs2}", `place` = "{place}", `main_stuff` = "{mainStuff}", `stuff` = "{stuff1}", `stuff2` = "{stuff2}", `notplayed` = {notplayed} where `id` = {id};',
            'insertMatch' => 'insert into `w_sport_match`(`h_team`, `a_team`, `h_score`, `a_score`, `h_shoots`, `a_shoots`, `h_penalty`, `a_penalty`, `h_extratime`, `a_extratime`, `comment`, `round`, `in_table`, `season`, `project_id`, `date`, `time`, `refs`, `refs2`, `place`, `main_stuff`, `stuff`, `stuff2`, `notplayed`) VALUES ({hTeamId}, {aTeamId}, {hScore}, {aScore}, {hShoots}, {aShoots}, {hPenalty}, {aPenalty}, {hExtratime}, {aExtratime}, "{comment}", {round}, {tableId}, {seasonId}, {projectId}, "{date}", "{time}", "{refs1}", "{refs2}", "{place}", "{mainStuff}", "{stuff1}", "{stuff2}", {notplayed});',
            'updateTableIdInStatsByMid' => 'update `w_sport_stats` set `table_id` = {tableId} WHERE `mid` = {mid};',
            'selectMatchByIdProjectId' => 'select `id`, `h_team`, `a_team`, `h_score`, `a_score`, `h_shoots`, `a_shoots`, `h_penalty`, `a_penalty`, `h_extratime`, `a_extratime`, `comment`, `round`, `in_table`, `season`, `date`, `time`, `refs`, `refs2`, `place`, `main_stuff`, `stuff`, `stuff2`, `notplayed` FROM `w_sport_match` WHERE `id` = {id} and `project_id` = {projectId};',
            'roundsByProjectIdSeasonId' => 'select `id`, `number`, `name`, `visible`, `season_id` from `w_sport_round` where `project_id` = {projectId} and `season_id` = {seasonId} order by `number`',
            'roundById' => 'select `id`, `number`, `visible`, `name` from `w_sport_round` where `id` = {id};',
            'updateRound' => 'update `w_sport_round` set `name` = "{name}", `number` = {number}, `visible` = {visible} where `id` = {id};',
            'insertRound' => 'insert into `w_sport_round`(`name`, `number`, `visible`, `season_id`, `project_id`) values ("{name}", {number}, {visible}, {season_id}, {project_id});',
            'roundDeleteById' => 'delete from `w_sport_round` where `id` = {id};'
        ),
        'user' =>
        array(
            'register' => 'insert into `user`(`group_id`, `name`, `surname`, `login`, `password`, `enable`) values ({groupId}, "{name}", "{surname}", "{username}", "{password}", {enable});',
            'addToGroup' => 'insert into `user_in_group`(`uid`, `gid`) values ({uid}, {gid});',
            'groupByName' => 'select `gid`, `name` from `group` where `name` = "{name}";',
            'userByUsername' => 'select `uid`, `name`, `surname`, `login`, `password` from `user` where `login` = "{username}";',
            'addUserInGroup' => 'insert into `user_in_group`(`uid`, `gid`) values ({uid}, {gid});'
        )
    );

    public function __construct() {
        
    }

    public function add($name, $query, $storage = 'default') {
        if ($name != '' && $storage != '') {
            $this->queries[$storage][$name] = $query;
        }
    }

    public function get($name, $params = array(), $storage = 'default') {
        //echo $name. ': ';
        //print_r($params);
        //echo '<br />';
        if (array_key_exists($name, $this->queries[$storage])) {
            $q = $this->queries[$storage][$name];
            foreach ($params as $key => $value) {
                $q = str_replace('{' . $key . '}', $value, $q);
            }
            return $q;
        } else {
            return '';
        }
    }

}

?>
