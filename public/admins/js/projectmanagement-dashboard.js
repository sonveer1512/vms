(function (factory) {
  typeof define === "function" && define.amd ? define(factory) : factory();
})(function () {
  "use strict";

  const { merge: merge } = window._;
  const echartSetOption = (e, t, o) => {
    const a = document.body;
    e.setOption(merge(o(), t)),
      a.addEventListener("clickControl", ({ detail: { control: a } }) => {
        "phoenixTheme" === a && e.setOption(window._.merge(o(), t));
      });
  };
  const resizeEcharts = () => {
    const e = document.querySelectorAll("[data-echart-responsive]");
    e.length > 0 &&
      e.forEach((e) => {
        echarts.getInstanceByDom(e)?.resize();
      });
  };
  const navbarVerticalToggle = document.querySelector(
    ".navbar-vertical-toggle"
  );
  navbarVerticalToggle &&
    navbarVerticalToggle.addEventListener("navbar.vertical.toggle", (e) =>
      resizeEcharts()
    );
  const tooltipFormatter = (e, t = "MMM DD") => {
    let o = "";
    return (
      e.forEach((e) => {
        o += `<div class='ms-1'>\n        <h6 class="text-700"><span class="fas fa-circle me-1 fs--2" style="color:${
          e.borderColor ? e.borderColor : e.color
        }"></span>\n          ${e.seriesName} : ${
          "object" == typeof e.value ? e.value[1] : e.value
        }\n        </h6>\n      </div>`;
      }),
      `<div>\n            <p class='mb-2 text-600'>\n              ${
        window.dayjs(e[0].axisValue).isValid()
          ? window.dayjs(e[0].axisValue).format(t)
          : e[0].axisValue
      }\n            </p>\n            ${o}\n          </div>`
    );
  };

  const issuesDiscoveredChartInit = () => {
    const { getColor: e, getData: t, resize: i } = window.phoenix.utils,
      a = document.querySelector(".echart-issue-chart");
    if (a) {
      const o = t(a, "echarts"),
        r = window.echarts.init(a);
      echartSetOption(r, o, () => ({
        color: [
          e("info-300"),
          e("warning-300"),
          e("danger-300"),
          e("success-300"),
          e("primary")
        ],
        tooltip: { trigger: "item" },
        responsive: !0,
        maintainAspectRatio: !1,
        series: [
          {
            name: "Tasks assigned to me",
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
                  color: e("gray-700"),
                  padding: [0, 0, 5, 15]
                },
                y: { fontSize: 12.8, color: e("gray-700"), fontWeight: 600 }
              }
            },
            emphasis: { label: { show: !0 } },
            labelLine: { show: !1 },
            data: [
              { value: 56, name: "QA & Testing" },
              { value: 24, name: "R & D" },
              { value: 36, name: "customer queries" },
              { value: 78, name: "Product design" },
              { value: 63, name: "Development" }
            ]
          }
        ],
        grid: { bottom: 0, top: 0, left: 0, right: 0, containLabel: !1 }
      })),
        i(() => {
          r.resize();
        });
    }
  };

  const zeroBurnOutChartInit = () => {
    const {
        getColor: e,
        getData: t,
        resize: o,
        getPastDates: i
      } = window.phoenix.utils,
      a = document.querySelector(".echart-zero-burnout-chart");
    if (a) {
      const r = t(a, "echarts"),
        n = window.echarts.init(a);
      echartSetOption(n, r, () => ({
        color: [e("gray-400"), e("success"), e("info"), e("warning")],
        tooltip: {
          trigger: "axis",
          backgroundColor: e("gray-soft"),
          borderColor: e("gray-200"),
          formatter: (e) => tooltipFormatter(e, "MMM DD, YYYY"),
          axisPointer: { shadowStyle: { color: "red" } }
        },
        legend: {
          bottom: "10",
          data: [
            { name: "Open", icon: "roundRect" },
            { name: "Issues found", icon: "roundRect" },
            { name: "In Progress", icon: "roundRect" }
          ],
          itemWidth: 16,
          itemHeight: 8,
          itemGap: 20,
          inactiveColor: e("gray-500"),
          inactiveBorderWidth: 0,
          textStyle: {
            color: e("gray-900"),
            fontWeight: 600,
            fontSize: 16,
            fontFamily: "Nunito Sans"
          }
        },
        xAxis: [
          {
            show: !0,
            interval: 2,
            axisLine: { lineStyle: { type: "solid", color: e("gray-300") } },
            axisLabel: {
              color: e("gray-900"),
              formatter: (e) => window.dayjs(e).format("D MMM"),
              interval: 5,
              align: "left",
              margin: 20,
              fontSize: 12.8
            },
            axisTick: { show: !0, length: 15 },
            splitLine: {
              interval: 0,
              show: !0,
              lineStyle: { color: e("gray-300"), type: "dashed" }
            },
            type: "category",
            boundaryGap: !1,
            data: i(15)
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
              lineStyle: { color: e("gray-300"), type: "solid" }
            },
            boundaryGap: !1,
            data: i(15)
          }
        ],
        yAxis: {
          show: !0,
          type: "value",
          axisLine: { lineStyle: { type: "solid", color: e("gray-300") } },
          axisLabel: {
            color: e("gray-900"),
            margin: 20,
            fontSize: 12.8,
            interval: 0
          },
          splitLine: {
            show: !0,
            lineStyle: { color: e("gray-300"), type: "solid" }
          },
          axisTick: {
            show: !0,
            length: 15,
            alignWithLabel: !0,
            lineStyle: { color: e("gray-300") }
          }
        },
        series: [
          {
            name: "Estimated",
            type: "line",
            symbol: "none",
            data: [20, 17.5, 15, 15, 15, 12.5, 10, 7.5, 5, 2.5, 2.5, 2.5, 0],
            lineStyle: { width: 0 },
            areaStyle: { color: e("primary-300"), opacity: 0.075 },
            tooltip: { show: !1 }
          },
          {
            name: "Issues found",
            type: "line",
            symbolSize: 6,
            data: [3, 1, 2, 4, 3, 1]
          },
          {
            name: "Open",
            type: "line",
            symbolSize: 6,
            data: [6, 5, 4, 6, 5, 5]
          },
          {
            name: "In Progress",
            type: "line",
            symbolSize: 6,
            data: [11, 12, 11, 9, 11, 6]
          },
          {
            name: "Actual",
            type: "line",
            symbolSize: 6,
            data: [20, 19, 15, 14, 12, 8],
            lineStyle: { type: "dashed" }
          }
        ],
        grid: { right: 5, left: 0, bottom: "15%", top: 20, containLabel: !0 }
      })),
        o(() => {
          n.resize();
        });
    }
  };

  const { docReady: docReady } = window.phoenix.utils;
  docReady(zeroBurnOutChartInit), docReady(issuesDiscoveredChartInit);
});
//# sourceMappingURL=projectmanagement-dashboard.js.map
