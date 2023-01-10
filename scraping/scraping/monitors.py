from spidermon import Monitor, MonitorSuite, monitors
from spidermon.contrib.actions.slack.notifiers import SendSlackMessageSpiderFinished
from spidermon.contrib.scrapy.monitors import BaseStatMonitor


@monitors.name("Error Count Monitor")
class ErrorCountMonitor(BaseStatMonitor):
    stat_name = "log_count/ERROR"
    threshold_setting = "SPIDERMON_MAX_ERRORS"
    assert_type = "<"
    fail_if_stat_missing = False

@monitors.name("Worning Count Monitor")
class WorningCountMonitor(BaseStatMonitor):
    stat_name = "log_count/WARNING"
    threshold_setting = "SPIDERMON_MAX_WARNINGS"
    assert_type = "<"
    fail_if_stat_missing = False

class SpiderCloseMonitorSuite(MonitorSuite):

    monitors = [
        ErrorCountMonitor,
        WorningCountMonitor,
    ]

    monitors_failed_actions = [
        SendSlackMessageSpiderFinished,
    ]

    