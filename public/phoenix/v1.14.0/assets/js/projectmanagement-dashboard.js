(function (factory) {
    typeof define === "function" && define.amd ? define(factory) : factory();
})(function () {
    "use strict";

    const { merge: merge } = window._;
    const echartSetOption = (e, t, o, r) => {
        const { breakpoints: a, resize: n } = window.phoenix.utils,
            s = (t) => {
                Object.keys(t).forEach((o) => {
                    window.innerWidth > a[o] && e.setOption(t[o]);
                });
            },
            i = document.body;
        e.setOption(merge(o(), t));
        const c = document.querySelector(".navbar-vertical-toggle");
        c &&
            c.addEventListener("navbar.vertical.toggle", () => {
                e.resize(), r && s(r);
            }),
            n(() => {
                e.resize(), r && s(r);
            }),
            r && s(r),
            i.addEventListener("clickControl", ({ detail: { control: r } }) => {
                "phoenixTheme" === r && e.setOption(window._.merge(o(), t));
            });
    };
    const echartTabs = document.querySelectorAll("[data-tab-has-echarts]");
    echartTabs &&
        echartTabs.forEach((e) => {
            e.addEventListener("shown.bs.tab", (e) => {
                const t = e.target,
                    { hash: o } = t,
                    r = o || t.dataset.bsTarget,
                    a = document
                        .getElementById(r.substring(1))
                        ?.querySelector("[data-echart-tab]");
                a && window.echarts.init(a).resize();
            });
        });
    const tooltipFormatter = (e, t = "MMM DD") => {
        let o = "";
        return (
            e.forEach((e) => {
                o += `<div class='ms-1'>\n        <h6 class="text-body-tertiary"><span class="fas fa-circle me-1 fs-10" style="color:${
                    e.borderColor ? e.borderColor : e.color
                }"></span>\n          ${e.seriesName} : ${
                    "object" == typeof e.value ? e.value[1] : e.value
                }\n        </h6>\n      </div>`;
            }),
            `<div>\n            <p class='mb-2 text-body-tertiary'>\n              ${
                window.dayjs(e[0].axisValue).isValid()
                    ? window.dayjs(e[0].axisValue).format(t)
                    : e[0].axisValue
            }\n            </p>\n            ${o}\n          </div>`
        );
    };
    const handleTooltipPosition = ([e, , t, , o]) => {
        if (window.innerWidth <= 540) {
            const r = t.offsetHeight,
                a = { top: e[1] - r - 20 };
            return (a[e[0] < o.viewSize[0] / 2 ? "left" : "right"] = 5), a;
        }
        return null;
    };

    const issuesDiscoveredChartInit = () => {
        const {
                getColor: e,
                getData: t,
                toggleColor: i,
            } = window.phoenix.utils,
            o = document.querySelector(".echart-issue-chart");
        if (o) {
            const a = t(o, "echarts"),
                r = window.echarts.init(o);
            echartSetOption(r, a, () => ({
                color: [
                    i(e("info-light"), e("info-dark")),
                    i(e("warning-light"), e("warning-dark")),
                    i(e("danger-light"), e("danger-dark")),
                    i(e("success-light"), e("success-dark")),
                    e("primary"),
                ],
                tooltip: {
                    trigger: "item",
                    position: (...e) => handleTooltipPosition(e),
                },
                responsive: !0,
                maintainAspectRatio: !1,
                series: [
                    {
                        name: "Perro",
                        type: "pie",
                        radius: ["48%", "90%"],
                        startAngle: 30,
                        avoidLabelOverlap: !1,
                        label: {
                            show: !1,
                            position: "center",
                            formatter: "{x|{d}%} \n {y|{b}}",
                            rich: {
                                x: {
                                    fontSize: 31.25,
                                    fontWeight: 800,
                                    color: e("tertiary-color"),
                                    padding: [0, 0, 5, 15],
                                },
                                y: {
                                    fontSize: 12.8,
                                    color: e("tertiary-color"),
                                    fontWeight: 600,
                                },
                            },
                        },
                        emphasis: { label: { show: !0 } },
                        labelLine: { show: !1 },
                        data: [
                            { value: 78, name: "Product design" },
                            { value: 63, name: "Perro" },
                            { value: 56, name: "QA & Testing" },
                            { value: 36, name: "Customer queries" },
                            { value: 24, name: "R & D" },
                        ],
                    },
                ],
                grid: {
                    bottom: 0,
                    top: 0,
                    left: 0,
                    right: 0,
                    containLabel: !1,
                },
            }));
        }
    };

    const zeroBurnOutChartInit = () => {
        const {
                getColor: o,
                getData: e,
                getPastDates: t,
            } = window.phoenix.utils,
            i = document.querySelector(".echart-zero-burnout-chart");
        if (i) {
            const r = e(i, "echarts"),
                a = window.echarts.init(i);
            echartSetOption(a, r, () => ({
                color: [
                    o("quaternary-color"),
                    o("success"),
                    o("info"),
                    o("warning"),
                ],
                tooltip: {
                    trigger: "axis",
                    backgroundColor: o("body-bg"),
                    borderColor: o("secondary-bg"),
                    formatter: (o) => tooltipFormatter(o, "MMM DD, YYYY"),
                    axisPointer: { shadowStyle: { color: "red" } },
                },
                legend: {
                    bottom: "10",
                    data: [
                        { name: "Open", icon: "roundRect" },
                        { name: "Issues found", icon: "roundRect" },
                        { name: "In Progress", icon: "roundRect" },
                    ],
                    itemWidth: 16,
                    itemHeight: 8,
                    itemGap: 10,
                    inactiveColor: o("quaternary-color"),
                    inactiveBorderWidth: 0,
                    textStyle: {
                        color: o("body-color"),
                        fontWeight: 600,
                        fontSize: 16,
                        fontFamily: "Nunito Sans",
                    },
                },
                xAxis: [
                    {
                        show: !0,
                        interval: 2,
                        axisLine: {
                            lineStyle: {
                                type: "solid",
                                color: o("border-color"),
                            },
                        },
                        axisLabel: {
                            color: o("body-color"),
                            formatter: (o) => window.dayjs(o).format("D MMM"),
                            interval: 5,
                            align: "left",
                            margin: 20,
                            fontSize: 12.8,
                        },
                        axisTick: { show: !0, length: 15 },
                        splitLine: {
                            interval: 0,
                            show: !0,
                            lineStyle: {
                                color: o("border-color"),
                                type: "dashed",
                            },
                        },
                        type: "category",
                        boundaryGap: !1,
                        data: t(15),
                    },
                    {
                        show: !0,
                        interval: 2,
                        axisLine: { show: !1 },
                        axisLabel: { show: !1 },
                        axisTick: { show: !1 },
                        splitLine: {
                            interval: 1,
                            show: !0,
                            lineStyle: {
                                color: o("border-color"),
                                type: "solid",
                            },
                        },
                        boundaryGap: !1,
                        data: t(15),
                    },
                ],
                yAxis: {
                    show: !0,
                    type: "value",
                    axisLine: {
                        lineStyle: { type: "solid", color: o("border-color") },
                    },
                    axisLabel: {
                        color: o("body-color"),
                        margin: 20,
                        fontSize: 12.8,
                        interval: 0,
                    },
                    splitLine: {
                        show: !0,
                        lineStyle: { color: o("border-color"), type: "solid" },
                    },
                    axisTick: {
                        show: !0,
                        length: 15,
                        alignWithLabel: !0,
                        lineStyle: { color: o("border-color") },
                    },
                },
                series: [
                    {
                        name: "Estimated",
                        type: "line",
                        symbol: "none",
                        data: [
                            20, 17.5, 15, 15, 15, 12.5, 10, 7.5, 5, 2.5, 2.5,
                            2.5, 0,
                        ],
                        lineStyle: { width: 0 },
                        areaStyle: {
                            color: o("primary-light"),
                            opacity: 0.075,
                        },
                        tooltip: { show: !1 },
                    },
                    {
                        name: "Issues found",
                        type: "line",
                        symbolSize: 6,
                        data: [3, 1, 2, 4, 3, 1],
                    },
                    {
                        name: "Open",
                        type: "line",
                        symbolSize: 6,
                        data: [6, 5, 4, 6, 5, 5],
                    },
                    {
                        name: "In Progress",
                        type: "line",
                        symbolSize: 6,
                        data: [11, 12, 11, 9, 11, 6],
                    },
                    {
                        name: "Actual",
                        type: "line",
                        symbolSize: 6,
                        data: [20, 19, 15, 14, 12, 8],
                        lineStyle: { type: "dashed" },
                    },
                ],
                grid: {
                    right: 5,
                    left: 0,
                    bottom: "15%",
                    top: 20,
                    containLabel: !0,
                },
            }));
        }
    };

    const zeroRoadmapChartInit = () => {
        const { getItemFromStore: t } = window.phoenix.utils,
            e = document.querySelector(".gantt-zero-roadmap");
        if (e) {
            const a = e.querySelector(".gantt-zero-roadmap-chart");
            window.gantt.plugins({ tooltip: !0 }),
                (window.gantt.config.date_format = "%Y-%m-%d %H:%i"),
                (window.gantt.config.scale_height = 0),
                (window.gantt.config.row_height = 36),
                (window.gantt.config.bar_height = 12),
                (window.gantt.config.drag_move = !1),
                (window.gantt.config.drag_progress = !1),
                (window.gantt.config.drag_resize = !1),
                (window.gantt.config.drag_links = !1),
                (window.gantt.config.details_on_dblclick = !1),
                (window.gantt.config.click_drag = !1),
                t("phoenixIsRTL") && (window.gantt.config.rtl = !0);
            const n = {
                levels: [
                    {
                        name: "month",
                        scales: [
                            { unit: "month", format: "%F, %Y" },
                            { unit: "week", format: "Week #%W" },
                        ],
                    },
                    {
                        name: "year",
                        scales: [{ unit: "year", step: 1, format: "%Y" }],
                    },
                    {
                        name: "week",
                        scales: [
                            {
                                unit: "week",
                                step: 1,
                                format: (t) => {
                                    const e =
                                            window.gantt.date.date_to_str(
                                                "%d %M"
                                            ),
                                        a = window.gantt.date.add(t, -6, "day");
                                    return (
                                        "#" +
                                        window.gantt.date.date_to_str("%W")(t) +
                                        ", " +
                                        e(t) +
                                        " - " +
                                        e(a)
                                    );
                                },
                            },
                            { unit: "day", step: 1, format: "%j %D" },
                        ],
                    },
                ],
            };
            gantt.ext.zoom.init(n),
                gantt.ext.zoom.setLevel("week"),
                gantt.ext.zoom.attachEvent("onAfterZoom", function (t, e) {
                    document.querySelector(
                        "input[value='" + e.name + "']"
                    ).checked = !0;
                }),
                (gantt.config.columns = [
                    { name: "text", width: 56, resize: !0 },
                ]),
                (gantt.templates.task_class = (t, e, a) => a.task_class),
                (gantt.templates.task_cell_class = function (t, e) {
                    return "weekend";
                }),
                (gantt.templates.task_text = () => ""),
                window.gantt.init(a),
                window.gantt.parse({
                    data: [
                        {
                            id: 1,
                            text: "Planning",
                            start_date: "2019-08-01 00:00",
                            duration: 3,
                            progress: 1,
                            task_class: "planning",
                        },
                        {
                            id: 2,
                            text: "Research",
                            start_date: "2019-08-02 00:00",
                            duration: 5,
                            progress: 0.5,
                            task_class: "research",
                        },
                        {
                            id: 3,
                            text: "Design",
                            start_date: "2019-08-02 00:00",
                            duration: 10,
                            progress: 0.4,
                            task_class: "design",
                        },
                        {
                            id: 4,
                            text: "Review",
                            start_date: "2019-08-05 00:00",
                            duration: 5,
                            progress: 0.8,
                            task_class: "review",
                        },
                        {
                            id: 5,
                            text: "PERRO",
                            start_date: "2019-08-06 00:00",
                            duration: 10,
                            progress: 0.3,
                            open: !0,
                            task_class: "develop",
                        },
                        {
                            id: 6,
                            text: "Review II",
                            start_date: "2019-08-10 00:00",
                            duration: 4,
                            progress: 0.02,
                            task_class: "review-2",
                        },
                    ],
                    links: [
                        { id: 1, source: 1, target: 2, type: "0" },
                        { id: 2, source: 1, target: 3, type: "0" },
                        { id: 3, source: 3, target: 4, type: "0" },
                        { id: 4, source: 6, target: 5, type: "3" },
                    ],
                });
            const o = e.querySelectorAll("input[name=scaleView]"),
                i = e.querySelector("[data-gantt-progress]"),
                s = e.querySelector("[data-gantt-links]");
            o.forEach((t) => {
                t.addEventListener("click", (t) => {
                    window.gantt.ext.zoom.setLevel(t.target.value);
                });
            }),
                s.addEventListener("change", (t) => {
                    (window.gantt.config.show_links = t.target.checked),
                        window.gantt.init(a);
                }),
                i.addEventListener("change", (t) => {
                    (window.gantt.config.show_progress = t.target.checked),
                        window.gantt.init(a);
                });
        }
    };

    const { docReady: docReady } = window.phoenix.utils;
    docReady(zeroRoadmapChartInit),
        docReady(zeroBurnOutChartInit),
        docReady(issuesDiscoveredChartInit);
});
//# sourceMappingURL=projectmanagement-dashboard.js.map
